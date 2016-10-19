<html>
<body>
<h1>Hello {{{ $user->name }}}</h1>
@if($user->isBanned())
	<p>Sorry, but we had to ban you.</p>
	<p>If you have any questions you can send an email to {{{ $admin->email }}}.
@else
	<p>We are happy to inform you that we have removed your ban</p>
@endif
</html>