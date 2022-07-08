<?php

class PerfectMethod
{

	/**
	 * [scope] function methodName(type name, ...): void|[return-type]
	 * {
	 * [preconditions checks]
	 *
	 * [failure scenarios]
	 * [happy path]
	 * [postcondition checks]
	 * [return void|specific-return-type]
	 * }
	 *
	 */

	public function myPerfectMethod(string $attribute): void
	{
		// [preconditions checks]

		if ($attribute !== 'toto') {
			throw new InvalidArgumentException('Attribute is not toto');
		}

		Assert::maxLenght(15, $attribute); // Use Assertion method (Webmozart) -> This will throw exception for us.
	}

}

//Extract the attribute in VO
class MyAttribute
{
	public static function fromString(string $attribute): MyAttribute
	{
		if ($attribute !== 'toto') {
			throw new InvalidArgumentException('Attribute is not toto');
		}

		Assert::maxLenght(15, $attribute); // Use Assertion method (Webmozart) -> This will throw exception for us.

		return new self($attribute);
	}

}

// Therefor we have

class PerfectMethodWithVo
{
	public function myPerfectMethod(MyAttribute $attribute): void
	{
		// [preconditions checks]
			// --> Implicit in VO that throw InvalidArgumentException

		// [failure scenarios]


		$myAttribute = $this->findInDatabase($attribute); // This can throw InvalidArgumentException OR RuntimeException from the code calling the Database

		if($myAttribute < 500)
		{
			throw new RuntimeException('My attribute is not in the excepted range');
		}

		// [happy path]

		$result = $this->perfomSomething($attribute);

		// [postcondition checks]

			// May not be usuful with proper testing + internal use of value object.
			// You can also remove them like preconditions : Put the result inside a value object!

		// Like so -->
		return MyResult($result);
	}
}

// What about custom exception

// Multiple way to instanciate the exception
class perfectMethodCannotPerformSomething extends Exception
{
	public static function attributeIsNotFound() {
		return new self('the right message');
	}

	// ...
}

// Or only one but with named constructor anyway

class CannotFindAttribute extends Exception
{
	public static function forId(int $id) {
		return new self('We could\'nt find the ID ' . $id); //<-- this allow to provide a clear error message and can keep the code throwing it clean.
	}
}
