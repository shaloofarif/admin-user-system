<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Welcome to the User Dashboard</h1>
        <p>Hello, {{ Auth::user()->first_name }}!</p>
        <form action="{{ route('user.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <div class="container">
        <!-- <h2>Welcome, {{ Auth::user()->first_name }}</h2>
        <p>Your profile information is displayed below:</p> -->
        
        <ul>
            <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
            <li><strong>Mobile Number:</strong> {{ Auth::user()->mobile_no }}</li>
        </ul>
        
        <a href="{{ route('user.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
