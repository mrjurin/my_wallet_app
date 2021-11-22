@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-light">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                           
                        </tr>
                        <tr>
                            <td colspan="3">
                                <h5>List of Accounts</h5>
                                <hr>
                                <ul>
                                    @foreach ($user->accounts as $account)
                                        <li>{{ $account->account_name }} - {{ $account->account_no }} - {{ $account->balance }}</li>
                                    @endforeach
                                </ul>                              
                            </td>
                        </tr>
                    @endforeach
                    

                </tbody>
            </table>
        </div>
    </div>
@endsection