<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Session;
use Purifier;
use Image;
use Storage;

class PostController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = array();
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validar dados
        $this->validate($request, array(
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',     
            'category' => 'required|numeric',
            'body' => 'required',
            'featured_image' => 'sometimes|image'
        ));

        //Inserir no BD
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category;
        $post->body = Purifier::clean($request->body);

        //Save image if necessary
        if ($request->hasfile('featured_image')){
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);

            //Tell post where the post is

            $post->image = $filename;
        }

        $post->save();

        $post->tags()->sync($request->tags, false);

        //Put salvaria a mensagem
        Session::flash('success', 'The blog post was successfully saved!');

        //Redirecionar
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        $tags2 = array();
        foreach($tags as $tag){
            $tags2[$tag->id] = $tag->name;
        }
        return view('posts.edit')->withPost($post)->withCategories($categories)->withTags($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validamos os dados
        $original = Post::find($id);
        if($request->slug != $original->slug){
            $this->validate($request, array(
                'title' => 'required|max:255',
                'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category' => 'required|numeric',
                'body' => 'required'
            ));
        } elseif($request->featured_image && $request->featured_image != $original->image) {
            $this->validate($request, array(
                'featured_image' => 'image'
            ));    
        } elseif($request->slug == $original->slug){ 
            $this->validate($request, array(
                'title' => 'required|max:255',
                'category' => 'required|numeric',
                'body' => 'required'
            ));
        }

        //Editamos os dados
        $post = Post::find($id);
                        //Checks if image has been uploaded
                        if ($request->hasfile('featured_image')){
                            $image = $request->file('featured_image');
                            $filename = time() . '.' . $image->getClientOriginalExtension();
                            $location = public_path('images/' . $filename);
                            Image::make($image)->resize(800, 400)->save($location);
        
                            Storage::delete($original->image);
                            $post->image = $filename;
                        }
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category;
        $post->body = Purifier::clean($request->body);

        $post->save();

        if(isset($request->tags)){
            $post->tags()->sync($request->tags, true);
        } else {
            $post->tags()->sync(array());
        }
        //Redirecionar com mensagem
        Session::flash('success', 'The post was successfully edited');
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        Storage::delete($post->image);
        $post->delete();;

        Session::flash('success', "Post was successfully deleted.");
        return redirect()->route('posts.index');
    }
}
