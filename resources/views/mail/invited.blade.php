<html>
<body>
<h1>Hello {{{ $user->name }}}</h1>
<div>
	You are invited by {{{ $party->owner->name }}} to join a party!
</div>
<div>
	<b>party name:</b>
	<p>{{{ $party->name }}}</p>
	<b>Party description:</b>
	<p>{{{ $party->description }}}</p>
</div>
</html>