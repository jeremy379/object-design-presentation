<?php

class Bepark
{
	private int $bugPerDay = 0;

	public function bugPerDay(): int
	{
		return $this->bugPerDay;
	}

	public function addBug(): void
	{
		$this->bugPerDay++;
	}
}

$myClass = new Bepark();

var_dump($myClass->bugPerDay());
$myClass->addBug();
var_dump($myClass->bugPerDay());
$myClass->addBug();
var_dump($myClass->bugPerDay());