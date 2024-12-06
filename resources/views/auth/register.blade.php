<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<form method="POST" action="{{ route('register') }}">
    @csrf
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{ old('name') }}" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="{{ old('email') }}" required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>

    <label for="password_confirmation">Confirm Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required>

    <!-- Tambahkan input untuk Role -->
    <label for="role">Role</label>
    <select name="role" id="role" required>
        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
    </select>

    <button type="submit">Register</button>
</form>

</body>
</html>
