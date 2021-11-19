@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('transaction.store') }}" method="POST">
                @includeIf('transaction._form',[
                    'model'=>$transaction,
                    'button_name'=>'Create'
                ])
            </form>
            
        </div>
    </div>
@endsection