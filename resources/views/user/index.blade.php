@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{ session('theme') }} - {{ session('lang')  }} 
            <table class="table table-light">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <td></td>
                    </tr>
                </thead>
                <tbody>

                    @canany(['read user','edit user','add user'])
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                               <td>
                                <x-form.remove-button data-toggle="abc" :user="$user">
                                  Hello World
                                </x-form.remove-button>
                               </td>
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
                    @endcanany

                </tbody>
            </table>
        </div>
    </div>
@endsection