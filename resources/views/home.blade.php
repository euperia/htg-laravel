<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HTG Home</title>
</head>
<body>
    
    <h1>Welcome to HTG Laravel</h1>
    <h2>The Laravel implementation of Hit The Ground</h2>
    <p><em>Hit The Ground (HTG)</em> is a starter app for web development projects
    aimed at rapid prototyping.</p>
    <p>This is the Laravel implementation of HTG.</p>
    
    <h2>Your options are:</h2>
    <ul>
        <li><a href="{{ URL::route('auth_login') }}" title="Log In">Log in</a> to your HTG Dashboard.</li>
        <li><a href="{{ URL::route('auth_register') }}" title="Register">Register</a> with us first</li>
    </ul>
</body>
</html>