<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function simpan(Request $request)
    {
        $simpan = new Kegiatan();
        $simpan->hari = $request->hari;
        $simpan->kegiatan = $request->kegiatan;
        $simpan->status = $request->status;
        $simpan->save();

        Alert::success('Success', 'Berhasil Disimpan!');
        return redirect()->back();
    }

    public function ubahStatus($idkegiatan, $status)
    {
        $ubahdata = Kegiatan::find($idkegiatan);
        $ubahdata->status = $status;
        $ubahdata->save();

        Alert::success('Success', 'Berhasil Mengubah Data!');
        return redirect()->back();
    }

    public function hapus($id)
    {
        Kegiatan::find($id)->delete();
        return redirect()->back();
    }

    // Mengambil data kegiatan untuk modal edit
    public function edit($id)
    {
        $data = Kegiatan::findOrFail($id);
        return response()->json($data);
    }

    // Menyimpan perubahan dari modal edit
    public function editproses(Request $request, $id)
    {
        $simpan = Kegiatan::findOrFail($id);
        $simpan->hari = $request->hari;
        $simpan->kegiatan = $request->kegiatan;
        $simpan->status = $request->status;
        $simpan->save();

        Alert::success('Sukses', 'Berhasil Menyimpan Data');
        return redirect()->route('home');
    }

    public function index()
    {
        return view('home')->with([
            'datas' => Kegiatan::all()
        ]);
    }
}
