@extends('backend.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
       <a href="{{ route('users.create') }}" class="btn btn-primary">Create Users</a>
    </div>
    
</div>
@endsection