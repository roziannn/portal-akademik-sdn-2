@extends('layouts.master')

@section('title')
    Selamat Datang, {{ auth()->user()->name }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.css" />
@endpush

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Dashboard</h3>
        </div>

    </div>
@endsection
