@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Transactions</h3>
                </div>

                <div class="card-body">
                    <table class="table table-light">
                        <tbody>

                            @foreach ($transactions as $txn)
                                <tr>
                                    <td>{{ $txn->trans_id }}</td>
                                    <td>{{ $txn->amount }}</td>
                                    <td>{{ $txn->status }}</td>
                                    <td>{{ $txn->description }}</td>
                                </tr>
                            @endforeach
                            

                        </tbody>
                        
                    </table>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-lg-center">
                        {{ $transactions->links() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection