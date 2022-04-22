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

	public function addBug(): self
	{
		return new self($this->bugPerDay + 1);
	}
}

$myClass = new Bepark(0);
$myClass->addBug();

var_dump($myClass->bugPerDay());

$myClassIncremented = $myClass->addBug();
var_dump($myClassIncremented->bugPerDay());
