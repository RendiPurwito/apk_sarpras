<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BarangMasukController extends Controller
{
    // ? tampilan data
    public function index()
    {
        $data = BarangMasuk::select('barang_masuks.*', 'barangs.*', 'barang_masuks.id as id_barang')
            ->leftJoin('barangs', 'barangs.id', 'barang_masuks.barang_id')
            ->paginate(5);
        return view('Data Barang Masuk.table', ['data' => $data]);
    }

    // ?input data masuk
    public function create()
    {
        $databarang = Barang::all();
        return view('Data Barang Masuk.add', [
            'databarang' => $databarang
        ]);
    }

    // ? submit data masuk
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'barang_id' => 'required',
        //     'stok_masuk' => 'required',
        //     'foto' => 'required|image|mimes:jpg,png,jpeg',
        //     'tanggal_masuk' => 'required',
        // ]);
        $barangMasuk = BarangMasuk::create($request->all());
        $barang = Barang::find($request->barang_id);

        // $barangs = BarangMasuk::where('barang_id', $request->barang_id)->get();
        $total = 0;
        // foreach ($barangs as $key => $barang) {
        $total += $barangMasuk->stok_masuk;
        // }

        $barang->update([
            'stok_barang' => $total + $barang->stok_barang,
        ]);


        // if ($request->hasFile('foto')) {
        //     $request->file('foto')->move('images/', $request->file('foto')->getClientOriginalName());
        //     $data->foto = $request->file('foto')->getClientOriginalName();
        //     $data->save();
        // }
        return redirect()->route('barangmasuk');
    }

    // ? tampilan edit masuk
    public function edit($id)
    {
        $data = BarangMasuk::find($id);
        $databarang = Barang::all();
        return view('Data Barang Masuk.formedit', compact('data', 'databarang'));
    }

    // ? submit edit masuk
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'tanggal_masuk' => 'required',
            'barang_id' => 'required',
            'stok_masuk' => 'required'
        ]);

        $data = BarangMasuk::find($id);

        if ($data->barang_id != $request->barang_id) {
            $barang = Barang::where('id', $data->barang_id)->first();
            $stok_barang = $barang->stock_barang - $data->stock_masuk;

            $barang->update([
                'stok_barang' => $stok_barang
            ]);
        };

        $data->update($validateData);

        $allBarangMasuk = BarangMasuk::where('barang_id', $data->barang_id)->get();

        $total = 0;
        foreach ($allBarangMasuk as $key => $barang) {
            $total += $barang->stok_masuk;
        }

        Barang::find($request->barang_id)->update([
            'stok_barang' => $total
        ]);

        return redirect()->route('barangmasuk');
    }

    // ? hapus data
    public function destroy($id)
    {
        $data = BarangMasuk::find($id);
        $data->delete();
        return redirect()->route('barangmasuk');
    }
}
