<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Operator;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BarangKeluarController extends Controller
{
    public function keluar()
    {
        $data = BarangKeluar::select('barang_keluars.*', 'barangs.*', 'users.*', 'barang_keluars.id as id_barang')
            ->leftJoin('barangs', 'barangs.id', 'barang_keluars.barang_id')
            ->leftJoin('users', 'users.id', 'barang_keluars.user_id')
            ->paginate(5);
        return view('Data Barang Keluar.table', ['data' => $data]);
    }

    public function create()
    {
        $databarang = Barang::all();
        $datauser = User::all();
        return view('Data Barang Keluar.add', [
            'databarang' => $databarang,
            'datauser' => $datauser,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $this->validate($request, [
        //     
        // ]);
        $validatedData = $request->validate([
            'nama_peminjam' => 'required',
            'barang_id' => 'required',
            'tanggal_keluar' => 'required',
            'jumlah_barang' => 'required',
            'keterangan' => 'required'
        ]);

        $validatedData['user_id'] = Auth::user()->id;

        $barangmasuk = Barangmasuk::where('barang_id', $request->barang_id)->get();
        $barangMasukJml = 0;
        foreach ($barangmasuk as $key => $barang) {
            $barangMasukJml += $barang->stok_masuk;
        }

        $barangKeluar = BarangKeluar::where('barang_id', $request->barang_id)->get();
        $barangKeluarJml = 0;
        foreach ($barangKeluar as $key => $barang) {
            $barangKeluarJml += $barang->jumlah_barang;
        }

        $hasil = $barangMasukJml - ($barangKeluarJml + $request->jumlah_barang);

        if ($hasil < 0) {
            return redirect()->route('barangkeluar')->with('status', 'Stok Barang Tidak Mencukupi');
        }

        Barang::find($request->barang_id)->update([
            'stok_barang' => $hasil
        ]);

        $data = BarangKeluar::create($validatedData);

        return redirect()->route('barangkeluar');
    }

    public function edit($id)
    {
        $data = BarangKeluar::find($id);
        $databarang = Barang::all();
        $datauser = User::all();
        return view('Data Barang Keluar.formedit', compact('data', 'databarang', 'datauser'));
    }

    public function update(Request $request, $id)
    {
        $data = BarangKeluar::find($id);
        // dd($data);

        $barangmasuk = Barangmasuk::where('barang_id', $request->barang_id)->get();
        $barangMasukJml = 0;
        foreach ($barangmasuk as $key => $barang) {
            $barangMasukJml += $barang->stok_masuk;
        }

        if ($data->barang_id != $request->barang_id) {

            $barang = Barang::find($data->barang_id);

            $hasil = $barangMasukJml + $data->jumlah_barang;

            $barang->update([
                'stok_barang' => $hasil
            ]);
        };

        $barangKeluar = BarangKeluar::where('barang_id', $request->barang_id)->get();
        $barangKeluarJml = 0;
        foreach ($barangKeluar as $key => $barang) {
            $barangKeluarJml += $barang->jumlah_barang;
        }

        $hasil2 = $barangMasukJml - ($barangKeluarJml + $request->jumlah_barang);

        if ($hasil2 < 0) {
            return redirect()->route('barangkeluar')->with('status', 'Stok Barang Tidak Mencukupi');
        }

        $data->update($request->all());

        return redirect()->route('barangkeluar');
    }

    public function destroy($id)
    {
        $data = BarangKeluar::find($id);
        $data->delete();
        return redirect()->route('barangkeluar');
    }
}
