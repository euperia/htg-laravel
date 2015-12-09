<!-- resources/views/emails/password.blade.php -->
<p>Hi</p>

<p>You, or someone claiming to be you, have requested a password reset.</p>

<p><a href="{{ url('password/reset/'.$token) }}">Click here to reset your password</a>.</p>