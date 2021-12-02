<?php

namespace Rombituon\Core\Traits;

use Haruncpi\LaravelIdGenerator\IdGenerator;

trait TransactionTrait 
{
    public function generateTxnId()
    {
        $trans_id = IdGenerator::generate([
            'table' => 'transactions', 
            'length' => 10, 
            'field'=>'trans_id',
            'prefix' =>'TXN-'
        ]);

        return $trans_id;
    }
}