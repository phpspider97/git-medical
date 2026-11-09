<?php
$array = [ 
    "Javascript object map" => "new Map([ ['key1', 'value1'],['key2', 'value2'] ]) || allows you to store key-value pairs where both the keys and values can be of any data type",


    "Generator function" => "special type of function that allows you to pause its execution using the yield keyword || function* abc(){} || yield || next()",

    "Prototype" => "Prototypes provide a way to share properties and methods between objects || Every object has a prototype || You can access an object's prototype using the __proto__ || abc.__proto__ (it load when it need) || custom Object.prototype.abc = 'xyz' ",

    "Deep and shallow copy" => "the concepts of deep copy and shallow copy refer to how objects or arrays are duplicated, and whether the duplication is done at a surface level (shallow) or includes nested structures (deep) || Shallow Copy only parent level but in deep it copy in nested level of object || Shallow copy using spread operator || Deep copy using JSON.parse and JSON.stringify || A shallow copy creates a new object or array, but it doesn't create new copies of the nested objects or arrays within the original structure || structuredClone()",

    "Object" => "In javascript all things are {} || when copy it execute refrence copy not value copy",

    "Event Bubbling" => "If parent and child have same event if execute child corrsponding parent event || execute e.stoppropogation()",

    "Private property and function" => "This approach provides a level of encapsulation || add # front of property and function",

    "Nullish Coalescing Operator" => "For check undefined and null use ??",

    "BigInt" => "It handle big numeric value BigInt(1000000000) or simple add n after number like (1000n)",
 
    "Let, var & Const" => "Are used to declare variables || they have some differences in terms of scope, hoisting, and reassignment || block and var is function scope",
 
    "Template String" => '`This is ${abc} template string`',
 
    "Arrow function" => "Arrow functions are a concise and expressive way to write functions || Arrow functions do not have their own this binding, They inherit this from the enclosing scope || Arrow functions do not bind an arguments object || const abc = () => {}",

    "Rest operator" => "flexible ways to work with arrays and function parameters || function abc(arg1,...arg2) convert multiple argument into one array",

    "Spread operator" => "expand elements of an array, object, or string || [a,b,c] = ...arg",

    "Destructuring Array" => "[a,b,c] = ['x','y','z']",

    "Destructuring Object" => "{a,b,c} = {'x','y','z'}",

    "OOPS & class" => "inheritence, public, private, protected",

    "Modules" => "With the help of this use file data in another file || export & import",

    "Promise" => "Promises in JavaScript provide a way to work with asynchronous operations || They are a way to handle values that might be available now, later, or never. || code... (promise.js) || Promises provide a more structured and readable way to handle asynchronous code compared to callbacks.",

    "Promise All" => "Promise.all([abc1,abc2,abc3]).then().catch()",

    "Ajax" => "Asynchronous JavaScript and XML || ready state = 4 || 
            var xhttp = new XMLHttpRequest || xhttp.open('GET', 'ajax_info.txt', true) || xhttp.send()",

    "Fetch" => "The fetch() function in JavaScript is a modern API for making network requests, particularly HTTP requests. || fetch('url').then((response)=>response.json() || response.text()).then().catch()",

    "Async & Await" => "They are built on top of promises and provide a way to write asynchronous code that looks and behaves more like synchronous code || async function abc(){} || Alway return promise || Await ==> it pauses the execution of the function until the promise is resolved. ",

    "Symbols" => "Symbol is a primitive data type introduced in ECMAScript 6 (ES6) that represents a unique and immutable identifier || Symbol('abc') || alway return unique value",

    "Iterators" => "while(), do while(), for(), for of(), for in(), forech(), map() || let x= [a,b,c] let z= x[Symbol.iterator]() z.next()",
 
    "Strict mode" => "use strict",

    "Error handling" => "try{ code }catch(err){ err.name || err.message || err.stack} || type of error : EvalError, RangeError, ReferanceError, SyntaxError, TypeError, URIError, AggregateError",

    "set" => "Collection of unique value || new Set([1,2,3,4]) || new Set([1,2,3,4]).add('new element').delete('value') || map is key value pair but set only value",

    "at()" => "[1,2,3,4].at(-1) ==> get last value || [1,2,3,4].at(1) ==> get first value",

    "High Order function" => "A higher-order function is a function that either takes one or more functions as arguments or returns a function as its result. || example map, reduce, filter, foreach code... (hoc.js)",

    "Global Object" => "like alert, console etc || globalThis || only var make global property not let, not const",

    "Closure" => "A closure in JavaScript is a feature that allows a function to access variables from its outer (enclosing) lexical scope, even after the outer function has finished executing || Closures allow for the creation of private variables that are not directly accessible from the outside, providing a form of encapsulation. || Lexical scope outer variable use inside function but vise versa not possible || code... (closure.js)",

    "Call, apply & bind" => "call, apply, and bind are methods in JavaScript that are used to manipulate the context (the value of this) in which a function is executed. || When attach function with object then it need || code... (call-apply-bind.js) ",

    "Shadow DOM" => "Hidden dom",

    "Mutation Observer" => "Check any updation of element || code... (mutation-observer.js)",
   
    "Method Chaining" => "Chat gpt for example",
  
    "map vs foreach" => "map return but foreach not",
   
    "Currying" => "function sum(x){
        return (y)=>{
            return (z)=>{
                return x+y+z
            }
        }
    } || let abc = sum(5) || let xyz = abc(3) || xyz(6) || sum(5)(6)(7)",

    "Computed Property" => "Get value from dynamic value or variable",
 
    "Event Delegation" => "Unwanted event executed by made the parent eventhandler || event.target.id (return child or parent) and do condition",

    "Event loop" => "The event loop is a mechanism that helps manage asynchronous operations. It consists of a call stack, a callback queue, and an event loop",

    "Macro and micro task" => "Microtasks are typically tasks with higher priority || Microtasks include Promises,callbacks || Examples of macrotasks include setTimeout, setInterval, user input events",

    "Throttle & Debouncing" => "Throttling is a technique used to control the rate at which a function is executed specified time interval || Debouncing is a technique in JavaScript where a function call is delayed until after a certain period of inactivity",

    "Function declare & expression" => "declare ===> function functionName(parameters) {} || Expression ===> const functionName = function(parameters) {}",

    "create an object without a prototype" => "const myObject = Object.create(null) || myObject.property = 'value'",

    "How do you check if an object is empty" => "Object.keys(obj).length === 0;",

    "Promises chaining" => "That allows you to execute a sequence of asynchronous operations in a more readable and manageable way",

    "Proxy" => "Proxy is an object that is used to control access to another object || Its like interceptor",

    "Bubbling and capturing" => "Bubbling ===> child to parent || capturing ===> Parent to child",

    "Web workers" => "Enables you to run scripts in the background, separate from the main thread || Not execute window, document object || Worker, onmessage, postMessage",

    "Typecasting" => "change the data type of a value to another data type || Number(value), String(value)",

    "localStorage & sessionStorage" => "localStorage.setItem('username', 'JohnDoe') || sessionStorage.setItem('theme', 'light');",

    "Lazy loading" => "",

    "Progressive Web Apps" => ""
];



//WORK ON THAT : [ Deep and shallow copy video see || * ], [ Shadow DOM || *], [ Mutation Observer || * ], [ Proxy || * ], [ Web workers || * ], [ CORS || * ]







//console.log('%c Styled Log Message', 'color: green; font-weight: bold;');

include('bottom.php');