# What's this

This project is there in order to present some principles of designing objects and show you a list of guidelines that, while designing objects, 
will help your brain to automate writing code leaving room for higher logical thinking.

# Source

The Book Object Design style guide from Matthias Noback

Read it ;)
https://www.amazon.fr/Object-Design-Style-Matthias-Noback/dp/1617296856/ref=tmm_pap_swatch_0?_encoding=UTF8&qid=1654861977&sr=8-1 


# In real quick

### Usage of queries

- Use query to get data 
- They should have a single-type return 
  - no ?string or other nullable 
    - -> You can have NullObject. Page & EmptyPage for example
    - or empty array/Collection)
    - Throw if not found
- If the client needs to make a computation for queried data, that could be set into the returned object, or as a query method
- Use abstraction when crossing boundary (Api / Other BC / Database)
- Never call a command from a query


 A query method is a method you can use to retrieve a piece of information. 
Query methods should have a single return type.
You may still return null, but make sure to look for alternatives, like a null object or an empty list. 
Possibly throw an exception instead. 
Let query methods expose as little of an object’s internals as possible.

 Define specific methods and return values for every question you want to ask and every answer you want to get. 
Define an abstraction (an interface, free of implementation details) for these methods if the answer to the question can only be established by crossing the system’s boundaries.

### Usage of commands (performing tasks)

- Imperative form
- Limit the scope of a command method, and use events to perform secondary tasks
- When something goes wrong, throw an exception
- Use queries to collect information and commands to take the next steps
- Define abstractions for commands that cross system boundaries

### Dividing responsibilities

- Separate write models from read models
- Create read models that are specific for their use cases
- Create read models directly from their data source (Use direct SQL request)
- Build read models from domain events  (Spoiler: we don't do that.)

### Changing behaviour

 When you feel the need to change the behavior of a service, look for ways to make this behavior configurable through constructor arguments.
If this isn’t an option because you want to replace a larger piece of logic, look for ways to swap out dependencies, which are also passed in as constructor arguments.

 If the behavior you want to change isn’t represented by a dependency yet, extract one by introducing an abstraction: a higher level concept and an interface.
You will then have a part you can replace, instead of modify. 
Abstraction offers the ability to compose and decorate behaviors, so they can become more complicated without the initial service knowing about it (or being modified for it).

Answers to the exercises 227
 Don’t use inheritance to change the behavior of a service by overriding its methods. 
Always look for solutions that use object composition. In fact, com- pletely close all your classes down for inheritance: mark them as final and make all properties and methods private, unless they are part of the public interface of the class.