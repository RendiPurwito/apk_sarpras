<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Operator;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Rap2hpoutre\FastExcel\FastExcel;

class BarangKeluarController extends Controller
{
    //? tampil data keluar
    public function keluar()
    {
        $data = BarangKeluar::select('barang_keluars.*', 'barangs.*', 'users.*', 'barang_keluars.id as id_barang')
            ->leftJoin('barangs', 'barangs.id', 'barang_keluars.barang_id')
            ->leftJoin('users', 'users.id', 'barang_keluars.user_id')
            ->paginate(5);
        return view('Data Barang Keluar.table', ['data' => $data]);
    }

    //? tampilan input barang keluar
    public function create()
    {
        $databarang = Barang::all();
        $datauser = User::all();
        return view('Data Barang Keluar.add', [
            'databarang' => $databarang,
            'datauser' => $datauser,
        ]);
    }

    //? simpan input barang keluar
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

    //? tampilan edit data keluar
    public function edit($id)
    {
        $data = BarangKeluar::find($id);
        $databarang = Barang::all();
        $datauser = User::all();
        return view('Data Barang Keluar.formedit', compact('data', 'databarang', 'datauser'));
    }

    //? simpan data edit keluar
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'tanggal_keluar' => 'required',
            'barang_id' => 'required',
            'jumlah_barang' => 'required'
        ]);

        $data = BarangKeluar::find($id);


        $barang = Barang::where('id', $data->barang_id)->first();
        if ($data->barang_id != $id) {
            $stok_barang = $barang->stock_barang - $data->jumlah_barang;

            $barang->update([
                'stok_barang' => $stok_barang
            ]);
        };

        $data->update($validateData);

        $allBarangKeluar = BarangKeluar::where('barang_id', $data->barang_id)->get();

        $total = 0;
        foreach ($allBarangKeluar as $key => $barangKeluar) {
            $total += $barangKeluar->jumlah_barang;
        }

        Barang::find($id)->update([
            'stok_barang' => $total + $barang->stok_barang,
        ]);

        return redirect()->route('barangkeluar');
        $barangKeluar = BarangKeluar::find($id);
        $barang = Barang::find($barangKeluar->barang_id);

        // $kalkulasi = $request->jumlah_barang + $barang->stok_barang;

        // // if ($hasil2 < 0) {
        // //     return redirect()->route('barangkeluar')->with('status', 'Stok Barang Tidak Mencukupi');
        // // }
        // $barang->update(['stok_barang' => $kalkulasi]);

        // $barangKeluar->update($request->all());

        // return redirect()->route('barangkeluar');
    }

    // ? hapus data keluar
    public function destroy($id)
    {
        $data = BarangKeluar::find($id);
        $data->delete();
        return redirect()->route('barangkeluar');
    }

    public static function excel(){
        return (new FastExcel(BarangKeluar::select('users.name as operator','barangs.nama_barang', 'barangs.jenis_barang', 'barangs.foto', 'barang_keluars.tanggal_keluar', 'barang_keluars.jumlah_barang', 'barang_keluars.keterangan') 
        ->leftJoin('barangs', 'barangs.id', 'barang_keluars.barang_id') 
        ->leftJoin('users', 'users.id', 'barang_keluars.user_id') 
        ->get()))->download('databarangkeluar.xlsx');
    }
}
