<!DOCTYPE html>
<html>
<head><title>Sign In · Eduleb</title></head>
<body style="font-family:sans-serif;max-width:380px;margin:80px auto;">
<h2>Sign in</h2>
@if ($errors->any())
    <p style="color:#E14B4B;">{{ $errors->first() }}</p>
@endif
<form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" required style="width:100%;padding:10px;margin-bottom:10px;">
    <input type="password" name="password" placeholder="Password" required style="width:100%;padding:10px;margin-bottom:10px;">
    <button type="submit" style="width:100%;padding:10px;">Sign In</button>
</form>
</body>
</html>
