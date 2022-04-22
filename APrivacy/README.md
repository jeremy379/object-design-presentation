In general, a private scope is preferable and should be your default choice. 
Limiting access to object data helps the object keep its implementation details to itself. 
It ensures that clients won’t rely on any specific piece of data owned by the object, and that they will always talk to 
the object through explicitly defined public methods