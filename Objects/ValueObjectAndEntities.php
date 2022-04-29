<?php

class ValueObject
{

}

// a.k.a Models

class Entities
{

}


// 1. VALID STATE IS MANDATORY

class PositionWithInvalidState
{
	private int $x;
	private int $y;

	private function setX(int $x) { $this->x = $x; }
	private function setY(int $y) { $this->y = $y; }

	public function getX() { return $this->x; }
}

$position = new PositionWithInvalidState();
var_dump($position->getX()); //Throw exception


class PositionWithValidState
{
	public function __construct(private int $x, private int $y) //It's not possible anymore to create an invalid state of Position
	{}

	public function getX() { return $this->x; }
}
$position = new PositionWithInvalidState(10, 20);
var_dump($position->getX()); //OK



// 2. Data shoud be meaningful (In other words: validate what you get)

class GpsPosition
{
	public function __construct(private int $latitude, private int $longitude)
	{}
}

$position = new GpsPosition(-1000, 500); //<--  latitude: -90 / 90, longitude -180 /180

class GpsPositionWithValidation
{
	public function __construct(private int $latitude, private int $longitude)
	{
		if($latitude < -90 || $latitude > 90)
		{
			throw new Exception(); // --> We use Webmozart library
		}

		//...

	}
}

// 3. Extra computation can be set in the object

class Receipt
{
	public function __construct(private array $amounts, private double $total) // Btw, it's not a good practice to use double for amount. Multiply by 100 and use integer instead.
	{}
}

class ReceiptCompleted
{
	public function __construct(private array $amounts)
	{
		foreach($this->amounts as $amount)
		{
			if(!is_int($this->amount))
			{
				throw new InvalidArgumentException(); //Always validated

				/**
				 * Note about InvalidArgumentException vs CustomException
				 *
				 * Custom exception allow to catch and recover/return nicely to the user
				 * But InvalidArgumentException are thrown due to a bad usage from the client, you should fail hard and not try to recover.
				 */
			}
		}
	}

	public function total(): int
	{
		// ...
	}
}

// 3. Named constructor
//No we use an object for amount to put in the array

class Amount
{
	public function __construct(private int $amount)
	{

	}
}

// And we want to differenciate Addition and reduction

class AmountWithReduction
{
	public function __construct(private int $amount, bool $isReduction)
	{

	}
}

// Then it may be more convenient to do

class AmountWithNamedConstructor
{
	private function __construct(private int $amount) {}

	public static function cost(int $amount)
	{
		return new self($amount);
	}

	public static function reduction(int $amount)
	{
		return new self(-$amount);
	}
}

// 4. Use value object everywhere

final class User
{
    public function __construct(private string $emailAddress)
    {
	    if(! filter_var($this->emailAddress, FILTER_FLAG_EMAIL_UNICODE))
	    {
			throw new InvalidArgumentException('Email invalid');
	    }
    }
}

// Vs , extracting each attribute in value object, no need to revalidate anymore each data

final class Email
{
	public function __construct(private string $emailAddress)
	{
		if(! filter_var($this->emailAddress, FILTER_FLAG_EMAIL_UNICODE))
		{
			throw new InvalidArgumentException('Email invalid');
		}
	}
}

final class UserWithValidEmail
{
	public function __construct(private Email $emailAddress)
	{
	}
}



