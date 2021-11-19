<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\TransactionType;
use App\Models\User;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    private function getTransTypes(){
        return TransactionType::pluck('id','description');
    }

    private function getReceivers(){
        return User::pluck('id','name');
    }

    private function getFeeAmount($amount, $rate = 0.01){
        return ($amount * $rate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trans_id = IdGenerator::generate([
            'table' => 'transactions', 
            'length' => 10, 
            'field'=>'trans_id',
            'prefix' =>'TXN-'
        ]);

        $transaction = new Transaction();

        $transaction->trans_id = $trans_id;
        $transaction->amount = 0;

        return view('transaction.create',[
            'transaction'=>$transaction,
            'transaction_types'=>$this->getTransTypes(),
            'receivers'=>$this->getReceivers()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trans_data = [];
        $trans_data =  array_merge($request->except('id','_token'),[
            "fee"=>$this->getFeeAmount($request->amount,0.05),
            'user_id'=>1,
            'sender'=>1,
            'status'=>'completed'
        ]);

        $created = Transaction::create($trans_data);
        return "yeah";

        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
