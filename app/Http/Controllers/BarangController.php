<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();

        return view('barang.index', ['barang' => $barang]);
    }

    public function tambah()
    {
        return view('barang.form');
    }

    public function simpan(Request $request)
    {
        $data = [
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'kategori_barang' => $request->kategori_barang,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
        ];

        Barang::create($data);

        return redirect()->route('barang');
    }

    public function edit($id)
    {
        $barang = Barang::find($id)->first();

        return view('barang.form', ['barang' => $barang]);
    }

    public function update($id, Request $request)
    {
        $data = [
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'kategori_barang' => $request->kategori_barang,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
        ];

        Barang::find($id)->update($data);

        return redirect()->route('barang');
    }

    public function hapus($id)
    {
        $barang = Barang::find($id);
        
        if ($barang) {
            $barang->delete();
            return redirect()->route('barang', $id)->with('success', 'Barang berhasil dihapus.');
        } else {
            return redirect()->route('barang')->with('error', 'Barang tidak ditemukan.');
        }
    }
}
