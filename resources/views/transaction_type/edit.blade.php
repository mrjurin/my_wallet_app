@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="/txn_types/update/{{$transactionType->id}}" method="post">

                @include('transaction_type._form',[
                    'model'=>$transactionType,
                    'button_name'=>'Update'
                ])
            
                
            </form>
        </div>
    </div>
@endsection

