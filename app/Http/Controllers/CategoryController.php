<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::where('status', 1)->latest()->paginate(10);
        $categorys_archive = Category::where('status', 0)->latest()->paginate(10);
        return view('admin.category.index', compact('categorys','categorys_archive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        Category::create($input);

        return redirect()->route('category.index')
                        ->with('success','Data kategori berhasil ditambah');
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
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $input = $request->all();

        $category->update($input);

        return redirect()->route('category.index')
                        ->with('success','Data kategori berhasil ditambah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('categories')->where('id', $id)->update(['status' => 0]);

        return redirect()->route('category.index')
                        ->with('success','Data kategori berhasil di arsipkan');
    }

    public function unarchive($id)
    {
        DB::table('categories')->where('id', $id)->update(['status' => 1]);

        return redirect()->route('category.index')
                        ->with('success','Data kategori berhasil di aktifkan');
    }
}
