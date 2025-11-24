<!doctype html><html><head><meta charset="utf-8"><title>Show</title></head><body>
    <h1>User #{{ $user->id }}</h1>
    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Role: {{ $user->role }}</p>
    <p>Verified: {{ $user->isVerified() ? 'Yes' : 'No' }}</p>
    <a href="{{ route('user.index') }}">Back</a>
    </body></html>
    