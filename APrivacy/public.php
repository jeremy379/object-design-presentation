<?php

class MyProduct
{
	public float $price = 0;
}

$myClass = new MyProduct();

var_dump($myClass->price); // 0

$myClass->price = 10;
var_dump($myClass->price); // 10


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

$myClass = new WithInvalidValue('Jérémy Dillenbourg 123'); //Th digit should be removed
var_dump($myClass->name); // Jérémy Dillenbourg

$myClass->name = '12345';
var_dump($myClass->name); // 12345
