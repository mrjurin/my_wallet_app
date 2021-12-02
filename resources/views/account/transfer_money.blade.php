@extends('layouts.base')

@section('content')
        <div class="row">
            <div class="col-md-4">
                {!! Form::open(['url' => route('wallets.make_transfer',$wallet),'method'=>'post']) !!}

                <div class="form-group">
                    <label>From Account</label>
                     {!! Form::text('from_account',$wallet->id,[
                        'class'=>'form-control',
                        'disabled'
                    ]) !!}
                </div>

                <div class="form-group">
                    <label>Amount To Transfer</label>
                    {!! Form::number('transfer_amount',0,[
                        'class'=>'form-control'
                    ]) !!}
                </div>

                <div class="form-group">
                    <label>To Account</label>
                     {!! Form::select('to_account', $toAccounts ,null,['class'=>'form-control'])  !!}
                </div>

                {!! Form::submit('Transfer',['class'=>'btn btn-primary']) !!}

                {!! Form::close() !!}
            </div>
        </div>
 
@endsection