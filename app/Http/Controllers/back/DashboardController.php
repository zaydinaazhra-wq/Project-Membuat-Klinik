<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\TenagaMedis;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('back.dashboard.index', [
            'total_articles' => Article::count(),
            'total_tenaga_medis' => TenagaMedis::count(),
            'total_obat' => Obat::count(),
            'total_transaksi_today' => Transaksi::whereDate('created_at', Carbon::today())->count(), // hitung perhari
            'latest_articles' => Article::latest()->take(3)->get(),
            'latest_transactions' => Transaksi::with(['obat'])->latest()->take(3)->get(),
        ]);
    }
}
