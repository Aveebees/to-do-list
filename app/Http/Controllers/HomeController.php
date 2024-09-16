<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function simpan(Request $request){
            $simpan = new Kegiatan();
            $simpan->hari = $request->hari;
            $simpan->kegiatan = $request->kegiatan;
            $simpan->status = $request->status;
            $simpan->save();
            Alert::success('Success', 'Berhasil Disimpan!');
        return redirect() -> back();
        }
       
    public function ubahStatus($idkegiatan, $status){
            $ubahdata = Kegiatan::find($idkegiatan);
            $ubahdata->status = $status;
            $ubahdata->save();
            Alert::success('Success', 'Berhasil Mengubah Data!');
        return redirect() -> back();

    }
    public function hapus($id)
    {
        $hapus = Kegiatan::find($id)->delete();
        return redirect()->back();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')->with([
            'datas' => Kegiatan::all()
        ]);
    }
}
