<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Category;
use App\Tag;
// use Illuminate\Support\Carbon;

class PostController extends Controller
{
    protected $validationRule = [
        'title' => 'required|string|max:100',
        'content' => 'required',
        "published" => "sometimes|accepted",
        "category_id" => "nullable|exists:categories,id",
        "image" => "nullable|image|mimes:jpeg,bmp,png,svg|max:2048",
        "tag" => "nullable|exists:tags,id",
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRule);
        $data = $request->all();

        $newPost = new Post();
        $newPost->title = $data['title'];
        $newPost->content = $data['content'];
        $newPost->published = isset($data['published']); //true o false
        // $newPost->published = ($data['published']);
        $newPost->category_id = $data['category_id'];

        $slug = Str::of($data['title'])->slug("-");
        $count = 1;
        while (Post::where('slug', $slug)->first()) {
            $slug = Str::of($data['title'])->slug("-") . "-{$count}";
            $count++;
        }
        $newPost->slug = $slug;

        // $newPost->slug = $this->getSlug($newPost->title);
        // la traduzione in mysql = vai a prendere dalla tabella dei Post tutti quelli che hanno lo slug uguale a questa stringa qua e cambialo in questo modo

        // IMMAGINE
        if (isset($data['image'])) {
            $path_image = Storage::put("uploads", $data['image']); // uploads/nomeimg.jpg
            $newPost->image = $path_image;
        }

        $newPost->save();

        // METODO SYNC CON CONTROLLO
        if (isset($data['tags'])) {
            $newPost->tags()->sync($data['tags']);
        }
        return redirect()->route('admin.posts.show', $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $mytime = CarbonImmutable::now()->toDateTimeString();
        $post = Post::findOrFail($id);
        // dd($post);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
        // return view('admin.posts.edit')->with('post', 'categories', 'tags');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate($this->validationRule);
        $data = $request->all();
        // @dd($data);
        // @dd($data['published']);

        // condizione per evitare l'errore del dato non corrispondente nel DB
        if (isset($data['published'])) {
            if ($data['published'] == "on") {
                $data['published'] = "1";
                // };
            }
        } else {
            $data['published'] = "0";
        };
        // $post->update($data);
        // $data = $request->all();

        //controllo sullo slug
        if ($post->title != $data['title']) {
            $post->title = $data['title'];
            $slug = Str::of($post->title)->slug("-");
            if ($slug != $post->slug) {
                $post->slug = $this->getSlug($post->title);
            }
        }
        $post->category_id = $data['category_id'];
        $post->content = $data['content'];
        $post->published = isset($data["published"]);
        // IMMAGINE
        if (isset($data['image'])) {
            // cancello l'immagine
            Storage::delete($post->image);
            // salvo la nuova immagine
            $path_image = Storage::put("uploads", $data['image']);
            $post->image = $path_image;
        }
        $post->update();

        // METODO SYNC ANCHE QUI CON CONTROLLO
        if (isset($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->sync([]);
        // $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with("message", "Post with id: {$post->id} successfully deleted !");
    }

    // CREAZIONE FUNZIONE GET SLUG
    private function getSlug($title)
    {
        $slug = Str::of($title)->slug("-");
        $count = 1;

        //prendi il primo post il cui slug è uguale a $slug
        // se è presente allora genero un nuovo slug aggiungendo -$count
        while (Post::where("slug", $slug)->first()) {
            $slug = Str::of($title)->slug("-") . "-{$count}";
            $count++;
        }
        return $slug;
    }
}
