@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Pending Request</h4>
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
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $txn)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $txn->transaction_type_id }}</td>
                                    <td>{{ $txn->amount }}</td>
                                    <td>{{ $txn->receiver  }}</td>
                                    <td>{{ $txn->status }}</td>
                                </tr>
                            @endforeach
                            
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection