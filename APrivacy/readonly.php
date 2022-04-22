<?php

class Izix
{
	public readonly float $price = 5;
}

$myClass = new Izix();

var_dump($myClass->price); // 5
$myClass->price = 10; // EXCEPTION