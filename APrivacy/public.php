<?php

class Izix
{
	public float $price = 0;
}

$myClass = new Izix();

var_dump($myClass->price);

$myClass->price = 10;
var_dump($myClass->price);


// Example of how it can fail

class WithInvalidValue
{
	public string $name;

	public function __construct(string $name)
	{
		$this->name = $this->formatName($name);
	}

	public function formatName(string $name): string
	{
		return preg_replace('#[0-9]#', '', $name);
	}
}

$myClass = new WithInvalidValue('Jérémy Dillenbourg 123');
var_dump($myClass->name);

$myClass->name = '12345';
var_dump($myClass->name);

// Or with broken dependency

class WithBrokenDependency
{
	public string $name;
	//private string $firstname;
	//private string $lastname;

	public function __construct(string $name)
	{
		$this->name = $name;
	}

	public function name()
	{
		return $this->name;
		//return $this->firstname . ' ' . $this->lastname;
	}
}

$myClass = new WithBrokenDependency('');
$myClass->name = 'TOtO';
var_dump($myClass->name());
