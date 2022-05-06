<?php

class MutableFluent // DON'T
{
	public function withThat(): MutableFluent
	{
		return $this;
	}

	public function withThis(): MutableFluent
	{
		return $this;
	}
}

$class = new MutableFluent();
$class->withThat()->withThis();

// But do

class ImmutableFluent
{
	public function withThat(): ImmutableFluent
	{
		return new self;
	}

	public function withThis(): ImmutableFluent
	{
		return new self;
	}
}

// You can chain

$class = new ImmutableFluent();
$class->withThat()->withThis();



// Common bad usage: the query builder (inspired by the book, inspired by Doctrine)
// But laravel eloquent & query builder suffer the same troubles.

$queryBuilder = QueryBuilder::create();
$qb1 = $queryBuilder
	->select(/* ... */)
	->from(/* ... */)
	->where(/* ... */)
	->orderBy(/* ... */);

$qb2 = $queryBuilder
	->select(/* ... */)
	->from(/* ... */)
	->where(/* ... */)
	->orderBy(/* ... */);

// Running this will then override your first $qb1 by $qb2

// TO fix: return a clone

class QueryBuilder
{
	private string $param;

	public static function create(): QueryBuilder { return $this; }

	public function select($param): QueryBuilder {
		$this->param = $param;
		return $this;
	}

	public function from($param): QueryBuilder {
		$this->param = $param;
		return $this;
	}

	public function where($param): QueryBuilder {
		$this->param = $param;
		return $this;
	}

	public function orderBy($param): QueryBuilder {
		$this->param = $param;
		return $this;
	}
}