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
}
