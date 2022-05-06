# Immutability

We'll use immutability to make our class predicatable and to reused them to perform a similar tasks with different input.

Service must be immutable (we see that in Object/Services)

## What about other object?

### Entity

Given that the state of an entity changes over time, entities are MUTABLE objects.
Indeed, we can fill our entity and change it with methods like place(), addItem(), ... (note: these method must be :void)
As they are identifiable, we can reuse them

### Value objects

Value object should be IMMUTABLE
We don't care about one specific value object, we care about the data inside. 
If we change the data, it's a different value object.
Updating a value object is the same as having a new one, therefor it's better to have different object directly.

### DTO

There are no rules here.
We may want to fill DTO step by step, so they need to be mutable in these case.

## How to decide if an object should be immutable

If an object is a service, it’s clear: it should be immutable.
If it’s an entity, it’s expected to change, so it should be mutable. 
All other types of objects should be immutable, for all the reasons mentioned in the previous section.