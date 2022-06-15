<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Operator;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
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
        //     'nama_peminjam' => 'required',
        //     'barang_id' => 'required',
        //     'jumlah_barang' => 'required',
        //     'foto' => 'required|image|mimes:jpg,png,jpeg',
        //     'tanggal_keluar' => 'required',
        //     'operator_id' => 'required',
        // ]);


        $data = BarangKeluar::create($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('images/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
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
        $data->update($request->all());
        if ($request->hasFile('foto')) {
            $destination = 'images/' . $data->foto;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('foto');
            $extension = $file->getClientOriginalName();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $data->foto = $filename;
        }
        $data->update();
        return redirect()->route('barangkeluar');
    }

    public function destroy($id)
    {
        $data = BarangKeluar::find($id);
        $data->delete();
        return redirect()->route('barangkeluar');
    }
}
