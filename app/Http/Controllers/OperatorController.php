<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Operator;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index()
    {
        $data = Operator::paginate(5);
        return view('Operator.table', ['data' => $data]);
    }

    public function create(){
        $datauser = User::all();
        return view('Operator.add',[
            'datauser' => $datauser
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'user_id' => 'required'
        ]);
    
        Operator::create($request->all());
        return redirect()->route('operator');
    }

    public function edit($id){
        $data = Operator::find($id);
        $datauser = User::all();
        return view('Operator.formedit', compact('data', 'datauser'));
    }

    public function update(Request $request, $id){
        $data = Operator::find($id);
        $data->update($request->all());
        return redirect()->route('operator');
    }

    public function destroy($id){
        $data = Operator::find($id);
        $data->delete();
        return redirect()->route('operator');
    }
}
