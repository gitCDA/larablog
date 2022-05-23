<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Qd on fait la requête avec all() on fait plusieurs fois la même requête pour chq posts
        // $posts = Post::all() ;

        // Pour faire la requête en where_id en une seule fois
        //         category et user = fcts° dans le modèle à qui on affecte la fct° 'get()'
        $posts = Post::with('category', 'user')->latest()->get() ;
        
        return view('post.index', compact('posts')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all() ;

        return view('post.create', compact('categories')) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $imageName = $request->image->store('posts') ;

        Post::create([
            'name' => $request->name,
            'content' => $request->content,
            'image' => $imageName,
        ]);

        return redirect()->route('dashboard')->with('success', 'Votre post a été créé'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post')) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
//  Si la condition de Gate dans le AuthServiceProvider n'est pas remplie on affiche abort(403)
        if (! Gate::allows('update.post', $post)) {
            abort(403);
        }
        
        $categories = Category::all() ;

        return view('post.edit', compact('post', 'categories')) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $arrayUpdate = [
            'name' => $request->name,
            'content' => $request->content,
        ] ;

        if ($request->image != null) {

            $imageName = $request->image->store('posts') ;

            $arrayUpdate = array_merge($arrayUpdate, [
                'image' => $imageName
            ]) ;
        }

        $post->update($arrayUpdate) ;

        return redirect()->route('dashboard')->with('success', 'Votre post a été modifié'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
//  Si la condition de Gate dans le AuthServiceProvider n'est pas remplie on affiche abort(403)
        if (Gate::denies('destroy.post', $post)) {
            abort(403);
        }

        $post->delete() ;


        return redirect()->route('dashboard')->with('success', 'Votre post a été supprimé'); 

    }
}
