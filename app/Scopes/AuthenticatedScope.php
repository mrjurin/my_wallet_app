<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AuthenticatedScope implements Scope {


    public function apply(Builder $builder, Model $model)
    {
        
        
        $builder->where('id', '=', \Auth::user()->id);
    }
}
