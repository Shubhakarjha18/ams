@extends('backend.layouts.app')
@section('title', 'Companies Management')

@section('content')
<div class="container">
    <a href="{{ route('companies.create') }}" class="btn btn-primary mb-4">Create</a>

    <div class="card">
        <div class="card-header">
            <form method="GET" action="{{ route('companies.index') }}">
                <div class="row g-2 align-items-center">
                    <div class="col-md-4">
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control" 
                            placeholder="Search Companies..." 
                            value="{{ request('search') }}"
                        >
                    </div>

                    <div class="col-md-3">
                        <button class="btn btn-primary">Search</button>
                        @if(request('search'))
                            <a href="{{ route('companies.index') }}" class="btn btn-danger ms-1">
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Company Details</th>
                            <th>Contact Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($companies as $company)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $company->name ?? 'N/A' }}</strong><br>
                                <span class="badge bg-success">
                                    {{ $company->company_code ?? 'N/A' }}
                                </span>
                            </td>

                            <td>
                                <div>{{ $company->email ?? 'N/A' }}</div>

                                <div class="fw-bold">
                                    Link:
                                    <small class="text-info">
                                        {{ $company->website ?? 'http://www.domain.com' }}
                                    </small>
                                </div>

                                <span class="badge bg-warning text-dark">
                                    {{ $company->address ?? 'N/A' }} - {{ $company->phone ?? 'N/A' }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('companies.edit', $company->id) }}" 
                                   class="btn btn-secondary btn-sm">
                                    Edit
                                </a>

                                <button 
                                    type="button"
                                    class="btn btn-danger btn-sm delete-company"
                                    data-id="{{ $company->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No Company Found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $companies->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
$(document).on('click', '.delete-company', function () {
    let companyId = $(this).data('id');
    let url = "{{ route('companies.destroy', ':id') }}".replace(':id', companyId);

    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire('Deleted!', response.message, 'success');
                    location.reload();
                },
                error: function () {
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                }
            });
        }
    });
});
</script>
@endpush
