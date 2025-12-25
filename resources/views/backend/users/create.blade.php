@extends('backend.layouts.app')
@section('title','Create Users')
@section('content')
<div class="container">
    <div class="d-flex justify-content-end">
        <a href="{{ route('users.index') }}" class="btn btn-danger mb-3">Back</a>
    </div>
    <div class="card">
        <div class="card-header">
            Add New Users
        </div>
        <div class="card-body">
            <form id="create-users-form" action="" method="POST" enctype="multipart/form-data">
                @csrf
                
            </form>
        </div>
    </div>
</div>
@endsection