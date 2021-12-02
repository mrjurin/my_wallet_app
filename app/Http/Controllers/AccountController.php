<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Events\AccountTopuped;
use App\Events\AccountTransferred;
use Rombituon\Core\Traits\TransactionTrait;
use DB;
use Cookie;

class AccountController extends Controller
{

    use TransactionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        Cookie::queue('user_profile',json_encode([
        'name'=>$user->name,
        'email'=>$user->email
        ]));



        $wallets = Account::OwnAccounts();
        return view('account.index',compact('wallets'));
    }

    public function topup(Account $wallet){
        //dd($wallet);
        $user_profile = json_decode(Cookie::get('user_profile'));
        dd($user_profile->name);

        return view('account.topup',compact('wallet'));
    }

    public function make_topup(Request $request, Account $wallet){
        //topup
        //dd($request->all());
        //dd($wallet);
        $request->validate([
            'topup_amount'=>'required|min:1'
        ]);

        $wallet->balance += $request->topup_amount;
        $wallet->save();

        $options = [
            'topup_amount'=>$request->topup_amount,
            'message'=>'Top up transaction',
            'status'=>'Completed'
        ];

        event(new AccountTopuped($wallet, $options));

        return redirect()->route('wallets');
    }


    public function getToAccounts($fromAccount){
        return Account::getAccounts($fromAccount)->pluck('account_no','id');
    }


    public function transfer(Account $wallet)
    {
        $toAccounts = $this->getToAccounts($wallet->id);
        return view('account.transfer_money',compact('wallet','toAccounts'));
    }

    public function make_transfer(Request $request, Account $wallet)
    {
        $request->validate([
            'transfer_amount'=>'required|min:1'
        ]);

        //wallet - transferred amount
        $wallet->balance -= $request->transfer_amount;

        //another wallet + transferred amount
        $toWallet = Account::find($request->to_account);

        if(!empty($toWallet)){
            $toWallet->balance += $request->transfer_amount;

            if($toWallet->save()){

                //log transfer
                event(new AccountTransferred($wallet, $toWallet,  [
                    'message'=>'Successfully received from '.$wallet->id,
                    'status'=>'Completed',
                    'amount'=>$request->transfer_amount
                ]));


                //log decrease
                 event(new AccountTransferred($toWallet, $wallet,  [
                    'message'=>'Successfully transferred to '.$toWallet->id,
                    'status'=>'Completed',
                    'amount'=> -$request->transfer_amount
                ]));

                $wallet->save();
            }

                 
        }
        
        return redirect()->route('wallets');
    }





    public function addTwoNumber($param1,$param2){
        if(gettype($param1) == 'integer' && gettype($param2) == 'integer'){
        return $param1 + $param2;
        }

        return 0;
    }

    public function request_money(Account $wallet)
    {
        
        return view('account.request_money',compact('wallet'));
    }

    public function make_request_money(Request $request,Account $wallet)
    {

        //account request to
        $walletTo = Account::find($request->request_to);
        $walletFrom = $wallet;

        //dd($this->generateTxnId());

        $created = Transaction::create([
            'trans_id'=>$this->generateTxnId(),
            'transaction_type_id'=>'4',
            'user_id'=>\Auth::user()->id,
            'sender'=>\Auth::user()->id,
            'receiver'=>$walletTo->user_id,
            'status'=>'REQUEST',
            'description'=>'Request money from '.\Auth::user()->id,
            'account_id'=>$walletFrom->id,
            'amount'=>$request->request_amount,
            'fee'=>0
        ]);

        if($created)
            return redirect()->route('wallets');

    }

    public function confirm_request_money(Request $request, Account $wallet, $transaction)
    {
        DB::transaction(function() use ($wallet,$transaction,$request) {

          //update trxn request
          $txn = Transaction::withoutGlobalScopes()->find($transaction);

          $txn->status='Completed';

          
          //wallet to top up
          $wallet->balance += $request->request_amount;

          $txn->save();
          $wallet->save();


        });

       return redirect()->back();
    //   route('wallets.pending_request_confirmation');
    }


    public function pendingRequest()
    {
        $requests = Transaction::pendingRequest(\Auth::user()->id);
        return view('account.pending_request',compact('requests'));
    }

    public function pendingRequestConfirmation()
    {
        //dd(\Auth::user()->id);

        $fromAccounts = Account::OwnAccounts()->pluck('account_no','id');

        $requests = Transaction::pendingRequestConfirmation(\Auth::user()->id);

        return view('account.pending_request_confirmation',compact('requests','fromAccounts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
