@extends('layout')
@section('page_title', 'Superadmin Dashboard')
@section('breadcrumb')
    <li><a href="{{ route('getSuperAdminDash') }}"><i class="fa fa-dashboard"></i>Dash</a></li>
@endsection