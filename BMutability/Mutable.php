<?php

class Bepark
{
	private int $bugPerDay = 0;

	public function bugPerDay(): int
	{
		return $this->bugPerDay;
	}

	public function addBug(): void // On a mutable object, modifier methods should be command methods -> with imperative name
	{
		$this->bugPerDay++;
	}
}

$myClass = new Bepark();

var_dump('Initial amount of bug: ' . $myClass->bugPerDay());
$myClass->addBug();
var_dump('After method call: ' . $myClass->bugPerDay());


echo '----' . PHP_EOL;

// Now let's call another service and inject Bepark
$otherClass = new DoSomething($myClass);
$otherClass->doStuff(); // We call a unrelated method

//var_dump($myClass->bugPerDay());

// -> That's the issue we got multiple time with Carbon in our project. It's why we use CarbonImmutable now.

class DoSomething
{
	public function __construct(private Bepark $bepark)
	{
	}

	public function doStuff(): void
	{
		$test = 0.1 + 0.2;

		if($test !== 0.3)
		{
			$this->bepark->addBug(); //fun with float : https://andy-carter.com/blog/don-t-trust-php-floating-point-numbers-when-equating#:~:text=Internally%20PHP%20is%20using%20a,is%20not%20unique%20to%20PHP.
		}
	}
}
