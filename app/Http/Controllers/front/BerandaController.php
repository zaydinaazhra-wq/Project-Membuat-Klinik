<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Obat;
use App\Models\TenagaMedis;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BerandaController extends Controller
{

    public function index(): View
    {

        $articles = Article::where('status', 1)
                            ->latest()
                            ->take(15)
                            ->get();
        $tenagaMedis = TenagaMedis::latest()->get();

        $obats = Obat::latest()->get();

        return view('front.beranda', compact('articles', 'tenagaMedis', 'obats'));
    }


    public function semuaObat(Request $request): View
    {
        $search = $request->input('search');

        $obats = Obat::where('stok', '>', 0)
            ->when($search, fn($query, $search) => $query->where('nama_obat', 'like', "%{$search}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('front.daftar-obat', compact('obats', 'search'));
    }

    
    public function detailArtikel(string $slug): View
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $article->increment('views');

        $recentArticles = Article::where('id', '!=', $article->id)
            ->latest()
            ->take(5)
            ->get();

        return view('front.baca-artikel', compact('article', 'recentArticles'));
    }
}
