<?php

interface Dependency {
	public function doStuff(): void;
}

class Services //They perform tasks
{
	public function __construct(private Dependency $dependency, string $configString)
	{
		// Dependency must be in constructor, making them mandatory and preventing invalid service
		// If configuration are required, pass them too. (With laravel, we can bind them through service provider) (Ps: only inject what you need)

	}

	public function doStuff(): void
	{
		$this->dependency->doStuff();
	}

	public function doOtherStuff(int $id) // However, task relevant data should be passed as arguments, never in constructor
	{

	}
}


class ServicesWithoutContainerUsage
{
	/*
 * Whenever a service needs another service in order to perform its task, it should declare the latter explicitly
 * as a dependency and get it injected as a constructor argument.
 *
 * Other hidden depdencies than resolve() : cache(), session(), now() ...
 */

	public function __construct()
	{
	}

	public function doStuff()
	{
		$dependency = resolve(Dependency::class); //<-- That's an hidden dependency
		$dependency->doStuff();

		$dependency->doOtherStuff(now()); //<-- now() is another hidden depdency. Inject Clock instead.
	}
}


// Some bad example.

class ServicesNullable
{
	public function __construct(private ?Dependency $dependency, private ?string $configString)
		// Don't use nullable dependency.
		// It force you to do null check everytime you use them.
		// Use null object if really it's required.
	{
		if($dependency === null) {
			Log::error('dependency is null'); //It's not a good practice to do stuff in a constructor other than validation constructor argument.
			// With that log, any instanciation would write log in the system, even if we don't use the object.
			// In the book example, they also create an empty directory for the logging
		}
		if($configString === null) {}

		if(strlen($this->configString) < 5)
		{
			throw new Exception('config should be > 5'); //However, throwing if argument is invalid is good.
			// Exception should always be thrown as the object should not be created in an invalid state
		}
	}

	public function setConfig($config): void
	{
		// That's bad
			// It shouldn’t be possible to create an object in an incomplete state.
			// Services should be immutable, that is, impossible to change after they have been fully instantiated.
		$this->configString = $config;
	}

	public function ignoreErrors(bool $ignoreError)
	{
		$this->ignoreErrors = $ignoreError;
		// That's bad
			// Influencing behaviour after service was instanciated make it unpredictable.
	}
}

class NullDependency implements Dependency // A null object that can be passed as dependency. IT does nothing, but it prevent to do useless check.
{
	public function doStuff(): void
	{
		return;
	}
}

class ServiceMustBeImmutable // Example: a service as a controller
{
	public function __construct(private View $view)
	{

	}

	/*
	 * A service should be PREDICATBALE and therefor IMMUTABLE
	 * A service is usually instancied once, but reused multiple times
	 */
	public function render()
	{
		return $this->view->render();
	}
}

class View
{
	/*
	 * View can be used by multiple controller
	 * With service locator/container, same instance of view could be reused.
	 * Therefor, this example would not works well, as each time the View method would be rendered, it'll add the suffix. A few calls later and you get view_suffix_suffix_suffix
	 */
	private $view = 'view';

	public function render()
	{
		$this->view .= '_suffix';

		return $this->view;
	}
}

// Solution : return (new self)->view

// See BMutability !
