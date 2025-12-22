@extends('backend.layouts.app')
@section('title','Edit Company')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-end">
            <a href="{{ route('companies.index') }}" class="btn btn-danger mb-3">Back</a>
        </div>
        <div class="card">
            <div class="card-header">
                Edit New Company
            </div>
            <div class="card-body">
                <form action="{{ route('companies.update',$company->id)}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group mt-3">
                            <label for="name">Company Name <sup class="text-danger">*</sup></label>
                            <input type="text" name="name" class="form-control mt-2" value="{{ $company->name }}">
                        </div>
                        <div class="col-md-6 form-group mt-3">
                            <label for="email">Company Email <sup class="text-danger">*</sup></label>
                            <input type="text" name="email" class="form-control mt-2" value="{{ $company->email }}">
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6 form-group mt-3">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control mt-2" value="{{ $company->address }}">
                    </div>
                    <div class="col-md-6 form-group mt-3">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control mt-2" value="{{ $company->phone }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group mt-3">
                        <label for="website">Website</label>
                        <input type="text" name="website" class="form-control mt-2" value="{{ $company->website }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center mt-3">
                        <button class="btn btn-info w-50 form-control" type="submit">Update</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection