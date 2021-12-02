<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TransactionType;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function transactionType(){
        //belongsTo(TransactionType::class,'foreign_key_in_transaction','id_in_transaction_type');
        return $this->belongsTo(TransactionType::class,'transaction_type_id','id');
    }

    public function scopeSuccess($query){
        return \DB::table('transaction_types')->select('*')->get();
    }

    public function scopeUnsuccessful($query){
        return $query
                ->where('status','!=','completed')
                ->get();
    }

    public function scopeTransactionsByAccount($query,$account_id){
        return $query->where('account_id',$account_id);
    }

    public function scopePendingRequest($query,$user_id){
        return $query
                ->withoutGlobalScope(\App\Scopes\UserTransactionScope::class)
                ->where('user_id',$user_id)
                ->where('status','REQUEST')
                ->where('transaction_type_id','4')
                ->get();
    }

    public function scopePendingRequestConfirmation($query,$user_id){
        
        return $query
                ->withoutGlobalScope(\App\Scopes\UserTransactionScope::class)
                ->where('receiver',$user_id)
                ->where('status','REQUEST')
                ->where('transaction_type_id','4')
                ->get();
    }


    protected static function booted()
    {
        if(\Auth::check())
            static::addGlobalScope(new \App\Scopes\UserTransactionScope);
    }
    
}
