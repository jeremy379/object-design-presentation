<?php

// DTO are exception to VO & entities rules.
// VO & entities need to be in a valid states, once created we want to avoid data in them are messed up.

// DTO grab data from the outside world from primary type (Command are also DTO)
/*
 A DTO can be created using a regular constructor.
 Its properties can be set one by one.
 All of its properties are exposed.
 Its properties contain only primitive-type values.
 Properties can optionally contain other DTOs, or simple arrays of DTOs.
*/

class MyDTO
{
	public string $myVar;
}

class MyController
{
	public function storeStuff(Request $request)
	{

		$dto = new MyDTO();
		$dto->myVar = $request->myVar();

		$this->myServiceInjected->execute($dto); // The service will parse the DTO to valid value object or entities.
	}
}

// Note about user validation
// VO should not collect all issue in validated data, they should throw directly
// However, DTO should collect error to return useful data to the client (e.g with Laravel validation inside Request)

// 2. Filler are allowed here (Never in value object)

class MyDTOWithFiller
{
	public string $myVar;

	public static function fromRequestArray(array $data)
	{
		$this->myVar = $data['myVar'];

		return $this;
	}
}