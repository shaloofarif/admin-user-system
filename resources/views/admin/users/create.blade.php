@extends('admin.layout')

@section('title', 'Create User')

@section('content')
    <h3>Create New User</h3>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" id="first_name" required>
        </div>
        <div class="mb-3">
            <label for="mobile_no" class="form-label">Mobile No</label>
            <input type="text" name="mobile_no" class="form-control" id="mobile_no" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
@endsection
