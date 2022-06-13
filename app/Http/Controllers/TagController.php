<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::where('status', 1)->latest()->paginate(10);
        $tags_archive = Tag::where('status', 0)->latest()->paginate(10);
        return view('admin.tag.index', compact('tags','tags_archive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $input = $request->all();

        Tag::create($input);

        return redirect()->route('tag.index')
                        ->with('success','Data tag berhasil ditambah');
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
    public function edit($id)
    {
        return view('admin.tag.edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Tag $tag)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $input = $request->all();

        $tag->update($input);

        return redirect()->route('tag.index')
                        ->with('success','Data tag berhasil ditambah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('tags')->where('id', $id)->update(['status' => 0]);

        return redirect()->route('tag.index')
                        ->with('success','Data tag berhasil di arsipkan');
    }

    public function unarchive($id)
    {
        DB::table('tags')->where('id', $id)->update(['status' => 1]);

        return redirect()->route('tag.index')
                        ->with('success','Data tag berhasil di aktifkan');
    }
}
