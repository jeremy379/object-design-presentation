<?php

class MyProduct
{
	public readonly float $price = 5;
}

$myClass = new MyProduct();

var_dump($myClass->price); // 5
$myClass->price = 10; // EXCEPTION