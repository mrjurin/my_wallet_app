@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="/txn_types/store" method="post">
                @include('transaction_type._form',[
                    'model'=>$transactionType,
                    'button_name'=>'Create'
                ])
            </form>
        </div>
    </div>
@endsection
