@extends('layouts.base')

@section('content')
        <div class="row">
            <div class="col-md-4">
                {!! Form::open(['url' => route('wallets.make_request_money',$wallet),'method'=>'post']) !!}

                <div class="form-group">
                    <label>Requester Account</label>
                     {!! Form::text('from_account',$wallet->id,[
                        'class'=>'form-control',
                        'disabled'
                    ]) !!}
                </div>

                <div class="form-group">
                    <label>Request Amount</label>
                    {!! Form::number('request_amount',0,[
                        'class'=>'form-control'
                    ]) !!}
                </div>

                <div class="form-group">
                    <label>From Account</label>
                    {!! Form::text('request_to',null,[
                        'class'=>'form-control'
                    ]) !!}
                </div>

                {!! Form::submit('Request Money',['class'=>'btn btn-primary']) !!}

                {!! Form::close() !!}
            </div>
        </div>
 
@endsection