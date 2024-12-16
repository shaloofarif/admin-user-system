@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Total Users Card -->
            <div class="col-lg-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Users</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalUsers }}</h5>
                        <p class="card-text">Registered users in the system.</p>
                    </div>
                </div>
            </div>

            <!-- Recent Logins Table -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Recent Logins</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>User Email</th>
                                    <th>IP Address</th>
                                    <th>Login Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentLogins as $login)
                                    <tr>
                                        <td>{{ $login->email }}</td>
                                        <td>{{ $login->ip_address }}</td>
                                        <td>{{ $login->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No recent logins found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logout Button -->
        <div class="row mt-3">
            <div class="col-lg-12">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
