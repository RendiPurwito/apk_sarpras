<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BarangController extends Controller
{
    public function index(){
        $data = Barang::paginate(5) ;
        
        return view('Data Barang.table', compact('data'));
    }

    public function create(){
        return view('Data Barang.add');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'keterangan' => 'required',
            'jenis_barang' => 'required',
            'foto' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        $validatedData['stok_barang'] = 0;

        $data = Barang::create($validatedData);
        if($request->hasFile('foto')){
            $request->file('foto')->move('images/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('barang');
    }

    public function edit($id){
        $data = Barang::find($id);
        return view('Data Barang.formedit', compact('data'));
    }

    public function update(Request $request, $id){
        $data = Barang::find($id);
        $data->update($request->all());
        if ($request->hasFile('foto')) {
            $destination = 'images/'.$data->foto;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('foto');
            $extension = $file->getClientOriginalName();
            $filename = time().'.'.$extension;
            $file->move('images/', $filename);
            $data->foto = $filename;
        }
        $data->update();
        return redirect()->route('barang');
    }

    public function destroy($id){
        $data = Barang::find($id);
        $data->delete();
        return redirect()->route('barang');
    }
}
