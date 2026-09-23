<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.article.index', [
            'articles' => Article::with('Category')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.article.create', [
            'categories' => Category::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('articles', 'public');
        }

        $data['slug'] = Str::slug($data['title']);

        Article::create($data);

        return redirect()->route('back.article.index')->with('success', 'Data Artikel Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $articles = Article::findOrFail($id);
        return view('back.article.show', compact('articles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('back.article.edit', [
            'article'    => Article::find($id),
            'categories' => Category::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, string $id)
    {
        $data = $request->validated();

        $article = Article::findOrFail($id);

        if ($request->hasFile('img')) {
        $oldImage = $article->img;

        $file = $request->file('img');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('back', $fileName, 'public');

        if ($oldImage && Storage::disk('public')->exists('back/' . $oldImage)) {
            Storage::disk('public')->delete('back/' . $oldImage);
        }

        $data['img'] = $fileName;
        } else {
        $data['img'] = $article->img;
        }

        $data['slug'] = Str::slug($data['title']);

        $article->update($data);

        return redirect()->route('back.article.index')->with('success', 'Data Artikel Berhasil Diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);

        if ($article->img && Storage::disk('public')->exists('back/' . $article->img)) {
            Storage::disk('public')->delete('back/' . $article->img);
        }

        $article->delete();

        return redirect()
            ->route('back.article.index')
            ->with('error', 'Data Artikel Berhasil Dihapus');

    }
}
