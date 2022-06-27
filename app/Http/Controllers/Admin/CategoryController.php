<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Illuminate\Support\Str;

class CategoryController extends Controller
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
        // $categories = Category::all();
        $categories = Category::paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
        $newCategory = new Category();
        $newCategory->name = $data['name'];

        $slug = Str::of($data['name'])->slug("-");
        $count = 1;
        while (Category::where('slug', $slug)->first()) {
            $slug = Str::of($data['name'])->slug("-") . "-{$count}";
            $count++;
        }
        $newCategory->slug = $slug;
        // $newCategory->slug = $this->getSlug($newCategory->name);
        $newCategory->save();
        // la traduzione in mysql = vai a prendere dalla tabella dei Category tutti quelli che hanno lo slug uguale a questa stringa qua e cambialo in questo modo
        return redirect()->route('admin.categories.show', $newCategory->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        // dd($category);
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $posts = Post::all();
        return view('admin.categories.edit', compact('posts', 'category'));
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
        $request->validate($this->validationRule);
        $data = $request->all();
        if ($category->name != $data['name']) {
            $category->name = $data['name'];
            $slug = Str::of($category->name)->slug("-");
            if ($slug != $category->slug) {
                $category->slug = $this->getSlug($category->name);
            }
        }
        $category->update();
        return redirect()->route('admin.categories.show', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories.index')->with("message", "Category with id: {$category->id} successfully deleted !");
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
