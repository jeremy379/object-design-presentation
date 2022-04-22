<?php

class Izix
{
	private float $price = 0;

	public function price(): float { return $this->price; }
}

$myClass = new Izix();

var_dump($myClass->price);
//var_dump($myClass->price());