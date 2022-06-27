<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $validationRule = [
        'name' => 'required|string|max:100',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tags = Tag::all();
        $tags = Tag::paginate(5);
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
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
        $newTag = new Tag();
        $newTag->name = $data['name'];

        $slug = Str::of($data['name'])->slug("-");
        $count = 1;
        while (Tag::where('slug', $slug)->first()) {
            $slug = Str::of($data['name'])->slug("-") . "-{$count}";
            $count++;
        }
        $newTag->slug = $slug;
        // $newTag->slug = $this->getSlug($newTag->name);
        $newTag->save();
        // la traduzione in mysql = vai a prendere dalla tabella dei Tag tutti quelli che hanno lo slug uguale a questa stringa qua e cambialo in questo modo
        return redirect()->route('admin.tags.show', $newTag->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        // dd($tag);
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        $posts = Post::all();
        return view('admin.tags.edit', compact('posts', 'tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate($this->validationRule);
        $data = $request->all();
        if ($tag->name != $data['name']) {
            $tag->name = $data['name'];
            $slug = Str::of($tag->name)->slug("-");
            if ($slug != $tag->slug) {
                $tag->slug = $this->getSlug($tag->name);
            }
        }
        $tag->update();
        return redirect()->route('admin.tags.show', $tag->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->posts()->sync([]); //potrebbe essere superfluo, verificare
        // $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect()->route('admin.tags.index')->with("message", "Tag with id: {$tag->id} successfully deleted !");
    }

    private function getSlug($name)
    {
        $slug = Str::of($name)->slug("-");
        $count = 1;

        //prendi il primo post il cui slug è uguale a $slug
        // se è presente allora genero un nuovo slug aggiungendo -$count
        while (Post::where("slug", $slug)->first()) {
            $slug = Str::of($name)->slug("-") . "-{$count}";
            $count++;
        }
        return $slug;
    }
}
