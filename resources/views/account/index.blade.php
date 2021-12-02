@extends('layouts.base')

@section('content')
    <x-widgets.wallet :wallets="$wallets"></x-widgets.wallet>
@endsection