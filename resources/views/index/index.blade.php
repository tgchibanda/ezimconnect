@extends('index.dashboard')
@section('index')
@php
$id = Auth::user()->id;
$user = App\Models\User::find($id);
$status = $user->status;
@endphp

<div class="page-content">

    @if($status === 'active')
    <h4>Your account is <span class="text-success">Active</span> </h4>
    @else
    <h4>Your account is <span class="text-danger">InActive</span> </h4>
    <p class="text-danger"><b> Plz wait, admin will check and contact you soon.</b></p>
    @endif


</div>
@endsection