<?php

// a.k.a Models
// Entities are the application’s core objects. They represent important concepts from the business domain


// 1. Named constructor in entities -> Allow to use domain specific keyword (vs. using save() for example)

class Order
{
	private Uuid $uuid; // An entity has an identifier

	public static function place(): void // We place our order (note: we do not return anything)
	{

	}

	public function totalNetAmount(): int // It exposes some useful information.
	{

	}
}

class OrderWithMultipleNamedConstructor
{
	private function __construct(private int $id, private string $type) // Use private constructir
	{
		// Validate in the constructor to avoid multiple validation in each named constructor
		Assert::inArray($type, ['bid', 'place']); // Use Assertion (from webmozart for example)
	}

	public static function bid(int $id): Order
	{
		return new self($id, 'bid');
	}

	public static function place(int $id): Order
	{
		return new self($id, 'place');
	}
}