<?php

class Bepark
{
	private int $bugPerDay = 0;

	public function __construct(int $initialValue)
	{
		$this->bugPerDay = $initialValue;
	}

	public function bugPerDay(): int
	{
		return $this->bugPerDay;
	}

	public function withBugIncremented(): self // A modifier on an immutable object should return a modified copy  + Naming non-imperative, describe what it does: " I want this ... , but .." ==> I want this object, but with bug incremented
	{
		return new self($this->bugPerDay + 1); // +1 instead of ++

		//Note: it's this method responsability to ensure we cannot have invalid number.
	}
}

$myClass = new Bepark(0);
$myClass->withBugIncremented();

var_dump('Initial value: ' . $myClass->bugPerDay());

$myClassIncremented = $myClass->withBugIncremented();
var_dump('Incremented value: ' .$myClassIncremented->bugPerDay());
var_dump('Initial value: ' . $myClass->bugPerDay());



die;

// Now let's call another service and inject Bepark
$otherClass = new DoSomething($myClass);
$otherClass = $otherClass->doStuff(); // We call a unrelated method

var_dump('Value from initial class: ' . $myClass->bugPerDay());
var_dump('Value from immutable copy: ' .$otherClass->bepark()->bugPerDay());

// -> That's the issue we got multiple time with Carbon in our project. It's why we use CarbonImmutable now.

class DoSomething
{
	public function __construct(private Bepark $bepark)
	{
	}

	public function doStuff(): DoSomething
	{
		$test = 0.1 + 0.2;

		if($test !== 0.3)
		{
			$this->bepark = $this->bepark->withBugIncremented(); //fun with float : https://andy-carter.com/blog/don-t-trust-php-floating-point-numbers-when-equating#:~:text=Internally%20PHP%20is%20using%20a,is%20not%20unique%20to%20PHP.
		}

		return $this;
	}

	public function bepark(): Bepark
	{
		return $this->bepark;
	}
}
