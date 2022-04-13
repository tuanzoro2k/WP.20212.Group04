<?php
$i = 1;
if (isset($_POST['formInput'])) {
	$name = $_POST['name'];
	$uni = $_POST['uni'];
	$class = $_POST['class'];

	if (isset($name)) {
		echo "Hello, " . $name . '<br>';
	}
	if (isset($uni) && isset($class)) {
		echo "You are studying at " . $class . " , " . $uni . '<br>';
	}
	if (isset($_POST['hobby'])) {
		echo "Your hobby is: ";
		foreach ($_POST['hobby'] as $hobby) {
			echo '<br>	' . $i . ".  " . $hobby;
			$i++;
		}
	}
}
