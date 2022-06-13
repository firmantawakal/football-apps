<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Tag;
use App\Models\Image;
use App\Models\Category;
use App\Models\Menu1;
use App\Models\Menu2;
use App\Models\Menu2Image;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function home()
    {
        DB::statement("SET SQL_MODE=''");
        $blogs  = Posts::where('posts.status',1)
                         ->join('users', 'users.id', '=', 'posts.id_author')
                         ->join('categories', 'categories.id', '=', 'posts.id_category')
                         ->leftJoin('images', 'images.id_post', '=', 'posts.id')
                         ->select('images.name AS image_name', 'categories.name AS category_name', 'users.name', 'posts.*')
                         ->groupBy('posts.id')
                         ->orderBy('updated_at', 'desc')->paginate(8);

        return view('home', compact('blogs'));
    }

    public function getByCategory(String $cat)
    {
        $cat_id = Category::whereRaw('LOWER(name) = ?', [strtolower($cat)])->first()->id;
        $category = Category::whereRaw('LOWER(name) = ?', [strtolower($cat)])->first();

        DB::statement("SET SQL_MODE=''");
        $blogs  = Posts::where('id_category',$cat_id)
                        ->where('posts.status',1)
                         ->join('users', 'users.id', '=', 'posts.id_author')
                         ->join('categories', 'categories.id', '=', 'posts.id_category')
                         ->leftJoin('images', 'images.id_post', '=', 'posts.id')
                         ->select('images.name AS image_name', 'categories.name AS category_name', 'users.name', 'posts.*')
                         ->groupBy('posts.id')
                         ->orderBy('updated_at', 'desc')->paginate(8);

        return view('blogByCategory', compact('blogs','category'));
    }

    public function getByTag(String $tag)
    {
        $tag_id = Tag::whereRaw('LOWER(name) = ?', [strtolower($tag)])->first()->id;
        $category = Tag::whereRaw('LOWER(name) = ?', [strtolower($tag)])->first();

        DB::statement("SET SQL_MODE=''");
        // DB::table('posts')->where('id', $id)->update(['status' => 1]);
        $blogs  = Tag::where('post_tags.id_tag',$tag_id)
                        ->where('posts.status',1)
                         ->join('post_tags', 'tags.id', '=', 'post_tags.id_tag')
                         ->join('posts', 'posts.id', '=', 'post_tags.id_post')
                         ->join('users', 'users.id', '=', 'posts.id_author')
                         ->leftJoin('images', 'images.id_post', '=', 'posts.id')
                         ->select('images.name AS image_name', 'tags.name AS category_name', 'users.name', 'posts.*')
                         ->groupBy('posts.id')
                         ->orderBy('posts.updated_at', 'desc')->paginate(8);

        return view('blogByCategory', compact('blogs','category'));
    }

    public function blogDetail(String $slug)
    {
        $blog  = Posts::where('slug',$slug)
                         ->join('users', 'users.id', '=', 'posts.id_author')
                         ->join('categories', 'categories.id', '=', 'posts.id_category')
                         ->select('categories.name AS category_name', 'users.name', 'posts.*')
                         ->orderBy('updated_at', 'desc')->first();

        $tags  = Tag::where('post_tags.id_post',$blog->id)
                         ->where('tags.status',1)
                         ->join('post_tags', 'post_tags.id_tag', '=', 'tags.id')
                         ->select('tags.name')
                         ->orderBy('name', 'asc')->get();
        // dd($tags);
        $img_head  = Image::where('id_post',$blog->id)->first();
        $img_all   = Image::where('id_post',$blog->id)->get();
        $next = Posts::where('id', '>', $blog->id)->first();
        $prev = Posts::where('id', '<', $blog->id)->first();

        return view('blogDetail', compact('blog','tags','img_head','img_all','prev','next'));
    }

    public function menu1(String $slug)
    {
        $blog  = Menu1::where('slug',$slug)->first();
        return view('menu1', compact('blog'));
    }

    public function menu2(String $slug)
    {
        $blog  = Menu2::where('slug',$slug)->first();
        $img_head  = Menu2Image::where('id_menu2',$blog->id)->first();
        $img_all   = Menu2Image::where('id_menu2',$blog->id)->get();
        return view('menu2', compact('blog','img_head', 'img_all'));
    }
}
