<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index()
    {
        $data = User::paginate(5);
        return view('Operator.table', compact('data'));
    }
    
    public function edit($id){
        $data = User::find($id);
        return view('Operator.formedit', compact('data'));
    }

    public function update(Request $request, $id){
        $data = User::find($id);
        $data->update($request->all());
        return redirect()->route('operator');
    }

    public function destroy($id){
        $data = User::find($id);
        $data->delete();
        return redirect()->route('operator');
    }
}
