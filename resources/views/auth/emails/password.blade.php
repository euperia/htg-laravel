<p>Hi</p>

<p>You, or someone claiming to be you, have requested a password reset.</p>

<p>
    <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">Click here to reset your password</a>.
</p>