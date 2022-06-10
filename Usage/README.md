# Usage our object

A template for implementing methods

[scope] function methodName(type name, ...): void|[return-type]
{
    [preconditions checks]
    
    [failure scenarios]
    [happy path]
    [postcondition checks]
    [return void|specific-return-type]
}

## About custom exception class name

I quote: 

Naming invalid argument or logic exception classes
Contrary to popular belief, exception class names don’t need to have “Exception” in them. 
Instead, there are some naming helper sentences you could use. To indicate invalid arguments or logic errors, you could use the template “Invalid . . .”, 
such as InvalidEmailAddress, InvalidTargetPosition, or InvalidStateTransition.