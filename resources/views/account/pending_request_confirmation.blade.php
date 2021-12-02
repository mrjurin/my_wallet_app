@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Pending Request To Confirm</h4>
                </div>
                <div class="card-body">
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Transaction Type Id</th>
                                <th>Request Amount</th>
                                <th>Request To</th>
                                <th>Status</th>
                               <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($requests as $txn)
                                <form action="{{ route('wallets.confirm_request_money',['wallet'=>$txn->account_id,'transaction'=>$txn->id]) }}" method="POST">
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $txn->transaction_type_id }}</td>
                                    <td>{{ $txn->amount }}</td>
                                    <td>{{ $txn->receiver  }}</td>
                                    <td>{{ $txn->status }}</td>
                                    <td>
                                        {!! Form::select('from_account', $fromAccounts ,null,['class'=>'form-control'])  !!}
                                        {!! Form::hidden('request_amount',$txn->amount)  !!}
                                    </td>
                                    <td>
                                        
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-success">
                                                Confirm Request
                                            </button>
                                        
                                        
                                    </td>
                                </tr>
                                </form>
                            @endforeach
                            
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection