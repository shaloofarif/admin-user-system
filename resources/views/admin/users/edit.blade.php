@extends('admin.layout')

@section('title', 'Edit User')

@section('content')
    <h3>Edit User: {{ $user->first_name }}</h3>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" id="first_name" value="{{ $user->first_name }}" required>
        </div>
        <div class="mb-3">
            <label for="mobile_no" class="form-label">Mobile No</label>
            <input type="text" name="mobile_no" class="form-control" id="mobile_no" value="{{ $user->mobile_no }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update User</button>
    </form>
@endsection
