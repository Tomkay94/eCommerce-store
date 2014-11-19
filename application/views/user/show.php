<h2>User #<?= $user->id ?></h2>
<?php 

	echo "<p> ID = " . $user->id . "</p>";
	echo "<p> Login  = " . $user->login . "</p>";
	echo "<p> Email  = " . $user->email . "</p>";
	echo "<p> First Name  = " . $user->first . "</p>";
	echo "<p> Last Name  = " . $user->last . "</p>";
		
	echo "<p>" . anchor('user/edit','Edit') . "</p>";
?>	
