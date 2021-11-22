<?php

namespace App\Http\Controllers;

use App\Models\TransactionType;
use Illuminate\Http\Request;
use Validator;

class TransactionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $txn_types = TransactionType::paginate(5);
        // dd($txn_types); //die and dump
        return view('transaction_type.index',compact('txn_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transactionType = new TransactionType();
        return view('transaction_type.create',compact('transactionType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //                 'description'=>'required|numeric|min:1|max:3'
        //             ]);
        
        $rules = [
            'description'=>'required'
        ];

        $messages = [
            'description.required'=>'Please provide description'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if ($validator->fails()){

            return redirect('/txn_types/create')
                   ->withErrors($validator)
                   ->withInput();
        }

        $created = TransactionType::create($request->except('_token'));
        return redirect()->route('txn_types');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionType  $transactionType
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionType $transactionType)
    {
        return view('transaction_type.show',compact('transactionType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionType  $transactionType
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionType $transactionType)
    {
        return view('transaction_type.edit',compact('transactionType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionType  $transactionType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionType $transactionType)
    {
        $data = $request->except('_token','id');
        // dd($transactionType);
        $updated = TransactionType::find($transactionType->id)
                        ->update($data);
        return $updated ? "updated" : "failed";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionType  $transactionType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionType $transactionType)
    {
        $deleted = TransactionType::find($transactionType->id)
                                    ->delete();

        return redirect('/txn_types');
    }
}
