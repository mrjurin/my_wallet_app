<?php

namespace App\Listeners;

use App\Events\AccountTransferred;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Transaction;

class AccountTransfering
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AccountTransferred  $event
     * @return void
     */
    public function handle(AccountTransferred $event)
    {
        $walletFrom = $event->walletFrom;
        $walletTo = $event->walletTo;
        $options = $event->options;

        $trans_id = IdGenerator::generate([
            'table' => 'transactions',
            'length' => 10,
            'field'=>'trans_id',
            'prefix' =>'TXN-'           
        ]);
        
        Transaction::create([
             'trans_id'=>$trans_id,
             'transaction_type_id'=>3,
             'amount'=>$options['amount'],
             'fee'=>0,
             'description'=>$options['message'],
             'user_id'=>\Auth::user()->id,
             'status'=>$options['status'],
             'sender' => $walletFrom->id,
             'receiver'=> $walletTo->id,
             'account_id'=>$walletFrom->id
        ]);
    }
}
