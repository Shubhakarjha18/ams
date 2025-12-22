@extends('backend.layouts.app')
@section('title', 'Add Company')
@section('content')
<div class="container">
    <div class="d-flex justify-content-end">
        <a href="{{ route('companies.index') }}" class="btn btn-danger mb-3">Back</a>
    </div>
    <div class="card">
        <div class="card-header">
            Add New Company
        </div>
        <div class="card-body">
            <form id="company-form" action="{{ route('companies.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group mt-3">
                        <label for="name">Company Name <sup class="text-danger">*</sup></label>
                        <input type="text" name="name" class="form-control" placeholder="Company Name">
                        
                    </div>
                    <div class="col-md-6 form-group mt-3">
                        <label for="email">Company email <sup class="text-danger">*</sup></label>
                        <input type="text" name="email" class="form-control" placeholder="Company Email">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group mt-3">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Company Address">
                    </div>
                    <div class="col-md-6 form-group mt-3">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Company Phone">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group mt-3">
                        <label for="website">Website</label>
                        <input type="text" name="website" class="form-control" placeholder="Company Website">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center m-3">
                        <button id="submitBtn" class="btn btn-info w-50 form-control" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
    $('#company-form').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                digits: true,
                minlength: 5,
                maxlength: 20
            },
            website: {
                url: true
            }
        },
        messages: {
            name: {
                required: 'Please enter company name',
                minlength: 'Minimum 2 characters.'
            },
            email: {
                required: 'Please enter company email',
                email: 'Please enter a valid email'
            }
        },
        errorElement: 'span',
        errorClass: 'text-danger',
        errorPlacement: function (error, element){
            error.insertAfter(element);
        },
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            let $btn = $('#submitBtn');
            let url = $(form).attr('action')
            console.log(url);
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: $(form).serialize(),

                beforeSend: function (){
                    $btn.prop('disabled',true);
                    $btn.html('Saving...');
                },

                success: function (response) {
                    $btn.prop('disabled',false);
                    $btn.html('Save');

                    //success feedback
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Company added successfully'
                    });

                    // reset form
                    form.reset();
                    $('.form-control').removeClass('is-invalid');
                    $('span.text-danger').remove();
                },

                error: function (xhr){
                    console.log($xhr);
                    $btn.prop('disabled',false);
                    $btn.html('Save');
                }
            });
            return false;
        }
    });
});
</script>
@endpush