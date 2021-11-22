@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($txn_types as $type)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $type->id }}</td>
                                        <td>{{ $type->description}}</td>
                                        <td>
                                            <form action="/txn_types/destroy/{{ $type->id }}" method="post">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a class="btn btn-primary" href="/txn_types/show/{{ $type->id }}">View</a>
                                                    <a class="btn btn-warning" href="/txn_types/edit/{{ $type->id }}">Edit</a>
                                                    
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-danger" type="submit"> Delete</button>
                                                
                                                </div>
                                            </form>
                                            
                                            
                                            
                                        </td>
                                    </tr>
            
                                @empty
                                    <tr>
                                        <td colspan="3">
                                            <span class="alert alert-info">
                                                No Record Found
                                            </span>
                                        </td>
                                    </tr>
                                @endforelse
            
                            </tbody>

                        </table>
                        {{ $txn_types->links() }}
                    </div>
                </div>
            </div>
            
           
        </div>
    </div>
@endsection






