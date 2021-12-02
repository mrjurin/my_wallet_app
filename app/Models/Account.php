<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Account extends Model
{
    use HasFactory;

    public function transactions(){
        return $this->hasMany(Transaction::class,'account_id','id');
    }


    public function scopeGetAccounts($query, $except_account_id)
    {
       return $query->where('id','!=',$except_account_id)->get();
    }

    public function scopeOwnAccounts($query)
    {
       return $query->where('user_id','=',\Auth::user()->id)->get();
    }


    //protected static function booted()
    //{
    //    if(\Auth::check())
    //        static::addGlobalScope(new \App\Scopes\UserTransactionScope);
    //}
    
}
