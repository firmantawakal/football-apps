<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Image;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::selectRaw('categories.name,posts.*')
                        ->where('posts.status', 1)
                        ->join('categories','categories.id','=','posts.id_category')
                        ->latest('posts.created_at')->paginate(10);
        $posts_archive = Posts::where('status', 0)->latest()->paginate(10);
        return view('admin.post.index', compact('posts','posts_archive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status', 1)->orderByRaw('name DESC')->get();
        return view('admin.post.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|unique:posts|min:5|max:100',
            'content'     => 'required|string|min:5',
            'id_category' => 'required',
            'youtube'     => 'nullable',
            'id_author'   => 'required',
        ]);

        $validated['slug'] = Str::slug($validated['title'], '-');

        $data = Posts::create($validated);
        $id_post = $data->id;

        if ($request->hasfile('image')) {
            $images = $request->file('image');
            foreach($images as $image) {
                $random = mt_rand(1000000000, 9999999999);
                $destinationPath = 'image/post/';
                $name = date('YmdHis-').$random."." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $name);

                Image::create([
                    'id_post' => $id_post,
                    'name' => $name
                ]);
            }
        }

        return redirect()->route('post.index')
                        ->with('success','Data post berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $post)
    {
        $category = Category::where('status', 1)->orderByRaw('name DESC')->get();
        $images = Image::where('id_post',$post->id)->get();

        return view('admin.post.edit',compact('post','images','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:5|max:100|unique:posts,title,'.$post->id,
            'content' => 'required|string|min:5',
            'id_category' => 'required',
            'youtube_url'     => 'nullable',
            'id_author'   => 'required',
        ]);

        $validated['slug'] = Str::slug($validated['title'], '-');

        if ($request->hasfile('image')) {
            $images = $request->file('image');
            foreach($images as $image) {
                $random = mt_rand(1000000000, 9999999999);
                $destinationPath = 'image/post/';
                $name = date('YmdHis-').$random."." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $name);

                Image::create([
                    'id_post' => $post->id,
                    'name' => $name
                    ]);
            }
        }

        $post->update($validated);

        return redirect()->route('post.index')
                        ->with('success','Data post berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $post)
    {
        $input['status']=0;
        $post->update($input);
        return redirect()->route('post.index')
                        ->with('success','Data post berhasil di arsipkan');
    }

    public function unarchive($id)
    {
        DB::table('posts')->where('id', $id)->update(['status' => 1]);

        return redirect()->route('post.index')
                        ->with('success','Data post berhasil di aktifkan');
    }

    public function delete_images($id)
    {
        $images = Image::where('id', $id)->first();
        unlink("image/post/".$images->name);

        Image::where('id', $id)->delete();
        return ['response'=>'success'];
    }
}
