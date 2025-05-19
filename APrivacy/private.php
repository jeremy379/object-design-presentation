<?php

class MyProduct
{
	private float $price = 0;

	public function price(): float { return $this->price; }
}

$myClass = new MyProduct();

var_dump($myClass->price);
//var_dump($myClass->price());