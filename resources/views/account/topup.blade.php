@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-4">
            {!! Form::open(['url' => route('wallets.make_topup',$wallet),'method'=>'post']) !!}
            <div class="form-group">
                <label>Account ID</label>
                {!! Form::text('id',$wallet->id,['class'=>'form-control','disabled']) !!}
            </div>
            
            <div class="form-group">
                <label>Account Name</label>
                {!! Form::text('account_name',$wallet->account_name,[
                        'class'=>'form-control',
                        'disabled'
                    ]) !!}
            </div>

            <div class="form-group">
                <label>Account No.</label>
            {!! Form::text('account_no',$wallet->account_no,[
                'class'=>'form-control','disabled'
                ]) !!}
            </div>

            <div class="form-group">
                <label>Current Balance</label>
            {!! Form::text('balance',$wallet->balance,[
                'class'=>'form-control','disabled'
                ]) !!}
            </div>

            <div class="form-group">
                <label>Amount</label>
            {!! Form::number('topup_amount',0,[
                'class'=>'form-control'
                ]) !!}
            </div>

            {!! Form::submit('Top Up',['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection