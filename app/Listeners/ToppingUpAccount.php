<?php

namespace App\Listeners;

use App\Events\AccountTopuped;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Transaction;

class ToppingUpAccount
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
     * @param  \App\Events\AccountTopuped  $event
     * @return void
     */
    public function handle(AccountTopuped $event)
    {
        $account = $event->account;
        $options = $event->options;

        $trans_id = IdGenerator::generate([
            'table' => 'transactions',
            'length' => 10,
            'field'=>'trans_id',
            'prefix' =>'TXN-'           
        ]);
        
        Transaction::create([
             'trans_id'=>$trans_id,
             'transaction_type_id'=>2,
             'amount'=>$options['topup_amount'],
             'fee'=>0,
             'description'=>$options['message'],
             'user_id'=>\Auth::user()->id,
             'status'=>$options['status'],
             'sender' => $account->id
        ]);
        
    }
}
