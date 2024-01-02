<?php

namespace App\Http\Controllers;

use App\Models\UP;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DetailTransaksi;
use App\Models\Barang;
use App\Models\Transaksi;
use PDF;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        
        $this->middleware('auth');
    }
    public function index()
    {
        
        $user = Auth::user();
        $role = $user->role;
        $unit = $user->unit;
        $query = Transaksi::query();

        if ($role === 'admin') { 

            $Users = User::all();
            $Barangs= Barang::all();

            $Stoks = DetailTransaksi::select(
                'detail_transaksi.barang_id',
                DB::raw('SUM(CASE WHEN transaksi.trans_jenis = "Masuk" THEN detail_transaksi.barang_quantity ELSE 0 END - CASE WHEN transaksi.trans_jenis = "Keluar" THEN detail_transaksi.barang_quantity ELSE 0 END) as jumlah_tersedia')
            )
            ->join('transaksi', 'transaksi.id', '=', 'detail_transaksi.trans_id')
            ->join('barang', 'barang.id', '=', 'detail_transaksi.barang_id')
            ->when($unit != '13000', function ($query) use ($unit) {
                $allowedUnits = ['UP3 Padang', 'UP3 Solok', 'UP3 Bukittinggi', 'UP3 Payakumbuh'];
                return $query->whereHas('transaksi.up', function ($subquery) use ($unit, $allowedUnits) {
                    $subquery->where('up_id', $unit)->orWhereIn('up_id', $allowedUnits);
                });
            })
            ->groupBy('detail_transaksi.barang_id')
            ->orderBy('barang.barang_code')
            ->get();

            $hasil = DB::table('detail_transaksi')
                ->join('transaksi', 'detail_transaksi.trans_id', '=', 'transaksi.id')
                ->join('barang', 'detail_transaksi.barang_id', '=', 'barang.id')
                ->when($unit != '13000', function ($query) use ($unit) {
                    $allowedUnits = ['UP3 Padang', 'UP3 Solok', 'UP3 Bukittinggi', 'UP3 Payakumbuh'];
                    return $query->where(function ($subquery) use ($unit, $allowedUnits) {
                        $subquery->where('transaksi.up_id', $unit)
                            ->orWhereIn('transaksi.up_id', $allowedUnits);
                    });
                })
                ->groupBy('detail_transaksi.barang_id')
                ->select('detail_transaksi.barang_id')
                ->get();

            if ($unit === '13000'){
                $totalBarang = count($hasil);

                // Query untuk data dalam card (tanpa pagination)
                $dashboards = DetailTransaksi::select('barang_nama', 'barang_merk')
                    ->selectRaw('SUM(CASE WHEN trans_jenis = "Masuk" THEN barang_quantity ELSE 0 END) AS barang_masuk')
                    ->selectRaw('SUM(CASE WHEN trans_jenis = "Keluar" THEN barang_quantity ELSE 0 END) AS barang_keluar')
                    ->join('transaksi', 'detail_transaksi.trans_id', '=', 'transaksi.id')
                    ->join('barang', 'detail_transaksi.barang_id', '=', 'barang.id')
                    ->when($unit != '13000', function ($query) use ($unit) {
                        // Menambahkan kondisi berdasarkan relasi Up
                        $allowedUnits = ['UP3 Padang', 'UP3 Solok', 'UP3 Bukittinggi', 'UP3 Payakumbuh'];
                        return $query->whereHas('transaksi.up', function ($subquery) use ($unit, $allowedUnits) {
                            $subquery->where('up_id', $unit)->orWhereIn('up_id', $allowedUnits);
                        });
                    })
                    ->groupBy('barang_nama', 'barang_merk')
                    ->get();

                return view('dashboard.index', compact('dashboards', 'Barangs','Users','Stoks'));

            }else{
                
                $totalBarang = count($hasil);

                // Query untuk data dalam card (tanpa pagination)
                $dashboards = DetailTransaksi::select('barang_nama', 'barang_merk')
                    ->selectRaw('SUM(CASE WHEN trans_jenis = "Masuk" THEN barang_quantity ELSE 0 END) AS barang_masuk')
                    ->selectRaw('SUM(CASE WHEN trans_jenis = "Keluar" THEN barang_quantity ELSE 0 END) AS barang_keluar')
                    ->join('transaksi', 'detail_transaksi.trans_id', '=', 'transaksi.id')
                    ->join('barang', 'detail_transaksi.barang_id', '=', 'barang.id')
                    ->when($unit != '13000', function ($query) use ($unit) {
                        // Menambahkan kondisi berdasarkan relasi Up
                        $allowedUnits = ['UP3 Padang', 'UP3 Solok', 'UP3 Bukittinggi', 'UP3 Payakumbuh'];
                        return $query->whereHas('transaksi.up', function ($subquery) use ($unit, $allowedUnits) {
                            $subquery->where('up_id', $unit)->orWhereIn('up_id', $allowedUnits);
                        });
                    })
                    ->groupBy('barang_nama', 'barang_merk')
                    ->get();

                return view('dashboard.index', compact('dashboards', 'Barangs', 'totalBarang','Users','Stoks'));
            }

        }
        elseif ($role === 'user') {
            $Users = User::all();
            $Barangs= Barang::all();

            $Stoks = DetailTransaksi::select(
                'detail_transaksi.barang_id',
                DB::raw('SUM(CASE WHEN transaksi.trans_jenis = "Masuk" THEN detail_transaksi.barang_quantity ELSE 0 END - CASE WHEN transaksi.trans_jenis = "Keluar" THEN detail_transaksi.barang_quantity ELSE 0 END) as jumlah_tersedia')
            )
            ->join('transaksi', 'transaksi.id', '=', 'detail_transaksi.trans_id')
            ->join('barang', 'barang.id', '=', 'detail_transaksi.barang_id')
            ->when($unit != '13000', function ($query) use ($unit) {
                $allowedUnits = ['UP3 Padang', 'UP3 Solok', 'UP3 Bukittinggi', 'UP3 Payakumbuh'];
                return $query->whereHas('transaksi.up', function ($subquery) use ($unit, $allowedUnits) {
                    $subquery->where('up_id', $unit)->orWhereIn('up_id', $allowedUnits);
                });
            })
            ->groupBy('detail_transaksi.barang_id')->orderBy('barang.barang_code')
            ->get();

            $hasil = DB::table('detail_transaksi')
            ->join('transaksi', 'detail_transaksi.trans_id', '=', 'transaksi.id')
            ->join('barang', 'detail_transaksi.barang_id', '=', 'barang.id')
            ->when($unit != '13000', function ($query) use ($unit) {
                $allowedUnits = ['UP3 Padang', 'UP3 Solok', 'UP3 Bukittinggi', 'UP3 Payakumbuh'];
                return $query->where(function ($subquery) use ($unit, $allowedUnits) {
                    $subquery->where('transaksi.up_id', $unit)
                        ->orWhereIn('transaksi.up_id', $allowedUnits);
                });
            })
            ->groupBy('detail_transaksi.barang_id')
            ->select('detail_transaksi.barang_id')
            ->get();

            $totalBarang = count($hasil);
 
            // Query untuk data dalam card (tanpa pagination)
            $dashboards = DetailTransaksi::select('tanggal_trans', 'barang_nama', 'barang_merk')
                ->selectRaw('SUM(CASE WHEN trans_jenis = "Masuk" THEN barang_quantity ELSE 0 END) AS barang_masuk')
                ->selectRaw('SUM(CASE WHEN trans_jenis = "Keluar" THEN barang_quantity ELSE 0 END) AS barang_keluar')
                ->join('transaksi', 'detail_transaksi.trans_id', '=', 'transaksi.id')
                ->join('barang', 'detail_transaksi.barang_id', '=', 'barang.id')
                ->when($unit != '13000', function ($query) use ($unit) {
                    // Menambahkan kondisi berdasarkan relasi Up
                    $allowedUnits = ['UP3 Padang', 'UP3 Solok', 'UP3 Bukittinggi', 'UP3 Payakumbuh'];
                    return $query->whereHas('transaksi.up', function ($subquery) use ($unit, $allowedUnits) {
                        $subquery->where('up_id', $unit)->orWhereIn('up_id', $allowedUnits);
                    });
                })
                ->groupBy('tanggal_trans', 'barang_nama', 'barang_merk')
                ->get();

            return view('user.dashboard', compact('dashboards', 'Barangs', 'totalBarang','Users','Stoks'));

        } else {
            return abort(403,'Anda tidak memiliki izin untuk mengakses halaman ini.'); 
        }
    }    

    public function laporan()
    { 

        $Users = User::all();
        $Barangs= Barang::all();
        $user = Auth::user();
        $unit = $user->unit;

        $Stoks = DetailTransaksi::select(
            'detail_transaksi.barang_id',
            DB::raw('SUM(CASE WHEN transaksi.trans_jenis = "Masuk" THEN detail_transaksi.barang_quantity ELSE 0 END - CASE WHEN transaksi.trans_jenis = "Keluar" THEN detail_transaksi.barang_quantity ELSE 0 END) as jumlah_tersedia')
        )
        ->join('transaksi', 'transaksi.id', '=', 'detail_transaksi.trans_id')
        ->join('barang', 'barang.id', '=', 'detail_transaksi.barang_id')
        ->when($unit != '13000', function ($query) use ($unit) {
            $allowedUnits = ['UP3 Padang', 'UP3 Solok', 'UP3 Bukittinggi', 'UP3 Payakumbuh'];
            return $query->whereHas('transaksi.up', function ($subquery) use ($unit, $allowedUnits) {
                $subquery->where('up_id', $unit)->orWhereIn('up_id', $allowedUnits);
            });
        })
        ->groupBy('detail_transaksi.barang_id') // Include detail_transaksi.barang_id in the GROUP BY clause
        ->get();

        $totalBarang = count($Barangs);

        // Query untuk data dalam card (tanpa pagination)
        $dashboards = DetailTransaksi::select('tanggal_trans', 'barang_nama', 'barang_merk')
            ->selectRaw('SUM(CASE WHEN trans_jenis = "Masuk" THEN barang_quantity ELSE 0 END) AS barang_masuk')
            ->selectRaw('SUM(CASE WHEN trans_jenis = "Keluar" THEN barang_quantity ELSE 0 END) AS barang_keluar')
            ->join('transaksi', 'detail_transaksi.trans_id', '=', 'transaksi.id')
            ->join('barang', 'detail_transaksi.barang_id', '=', 'barang.id')
            ->when($unit != '13000', function ($query) use ($unit) {
                // Menambahkan kondisi berdasarkan relasi Up
                $allowedUnits = ['UP3 Padang', 'UP3 Solok', 'UP3 Bukittinggi', 'UP3 Payakumbuh'];
                return $query->whereHas('transaksi.up', function ($subquery) use ($unit, $allowedUnits) {
                    $subquery->where('up_id', $unit)->orWhereIn('up_id', $allowedUnits);
                });
            })
            ->groupBy('tanggal_trans', 'barang_nama', 'barang_merk')
            ->get();

        return view('laporan.index', compact('dashboards', 'Barangs','totalBarang','Stoks'));
    }
        

    public function filter(Request $request)
    {
        $Users = User::all();
        $Barangs= Barang::all();
        $user = Auth::user();
        $unit = $user->unit;

        $tanggalAwal = $request->input('tglawal');
        $tanggalAkhir = $request->input('tglakhir');

        $Stoks = DetailTransaksi::select(
            'detail_transaksi.barang_id',
            DB::raw('SUM(CASE WHEN transaksi.trans_jenis = "Masuk" THEN detail_transaksi.barang_quantity ELSE 0 END - CASE WHEN transaksi.trans_jenis = "Keluar" THEN detail_transaksi.barang_quantity ELSE 0 END) as jumlah_tersedia')
        )
        ->join('transaksi', 'transaksi.id', '=', 'detail_transaksi.trans_id')
        ->join('barang', 'barang.id', '=', 'detail_transaksi.barang_id')
        ->when($unit != '13000', function ($query) use ($unit) {
            $allowedUnits = ['UP3 Padang', 'UP3 Solok', 'UP3 Bukittinggi', 'UP3 Payakumbuh'];
            return $query->whereHas('transaksi.up', function ($subquery) use ($unit, $allowedUnits) {
                $subquery->where('up_id', $unit)->orWhereIn('up_id', $allowedUnits);
            });
        })
        ->groupBy('detail_transaksi.barang_id') // Include detail_transaksi.barang_id in the GROUP BY clause
        ->get();

        $totalBarang = count($Barangs);

        // Query untuk data dalam card (tanpa pagination)
        $dashboards = DetailTransaksi::select('tanggal_trans', 'barang_nama', 'barang_merk')
            ->selectRaw('SUM(CASE WHEN trans_jenis = "Masuk" THEN barang_quantity ELSE 0 END) AS barang_masuk')
            ->selectRaw('SUM(CASE WHEN trans_jenis = "Keluar" THEN barang_quantity ELSE 0 END) AS barang_keluar')
            ->join('transaksi', 'detail_transaksi.trans_id', '=', 'transaksi.id')
            ->join('barang', 'detail_transaksi.barang_id', '=', 'barang.id')
            ->when($unit != '13000', function ($query) use ($unit) {
                // Menambahkan kondisi berdasarkan relasi Up
                $allowedUnits = ['UP3 Padang', 'UP3 Solok', 'UP3 Bukittinggi', 'UP3 Payakumbuh'];
                return $query->whereHas('transaksi.up', function ($subquery) use ($unit, $allowedUnits) {
                    $subquery->where('up_id', $unit)->orWhereIn('up_id', $allowedUnits);
                });
            })
            ->groupBy('tanggal_trans', 'barang_nama', 'barang_merk')
            ->whereBetween('tanggal_trans', [$tanggalAwal, $tanggalAkhir]) 
            ->get();

        return view('laporan.index', compact('dashboards', 'Barangs','totalBarang','Stoks'));
    } 
}
