<?php
$array = [
 
    "Introduction" => " It is not language || Its run time environment execute javascript code with help of v8 engine || javascript browser side || node js server side || it is single threaded and async",

    "Basic Point Before Start with Code" => " Use for make API",

    "Install node & NPM" =>  "node -v || npm -v",

    "Make First Program" =>  "enter node in command and enter ( start node environment ) || in command enter node file-name",

    "JavaScript Fundamentals" => "export/import not working in node || it use module.exports={} and require('file-name') || arr.filter((item)=>item>3)",

    "Core Modules" => "Core module {eg : console (global), fs (non-global), Http, buffer } ( global || non-global ) && external module || require('fs') || __dirname,__filename",

    "Create Server" => "code folder... || http handle request and response",

    "Package.json" => "All package and it's dependancy mange by this file || npm init || npm i",

    "Nodemon" => "Package and module almost same || nodemon file-name",

    "basic API" => "code folder...",

    "Getting input from command line" => "node file-name parameter || process.argv || fs.writeFileSync fs.unlinkSync",

    "Display file list from folder" => "require('path').join('__dirname','file-name') || add multiple file with for loop || fs.readdir(dirPath,(err,files)=>{ files })",

    "CURD in file" => "fs.writeFileSync('path','any text insert into file') || fs.readFile('path','utf-8',(err,file)=>{ file }) || fs.appendFile('path','given text',(err)=>{ err }) || fs.rename('old-path','new-path',(err)=>{ err }) || fs.unlinkSync('path',(err)=>{ err }) || buffer is temp memory location",

    "Asynchronous Programming Language" => "Asynchronous programming is a style of writing code where tasks can be executed independently, and the program doesn't have to wait for each task to complete before moving on to the next one",

    "Handle Asynchronous Data" => "Callback Functions || Promises || Async/Await || Event Listeners || Observables",

    "How Node js Works" => "comming soon....",

    "Express js" => "It is a framework || npm i express || code...",

    "Routing Params" => "?name=mani || req.query.name",

    "Render HTML and JSON" => "res.send(html code, json code)",
  
    "Make static HTML page" => "let path = require('path').join('__dirname','file-name') || app.use(express.static(path))",

    "Remove extension from URL and 404 Page" => "code... (express-server.js)",
 
    "EJS Template Engine" => "npm i ejs || by default view folder executed || code... (ejs.js)",

    "Middleware" => "type : application level, route level, build in, third party || code... (middleware.js)",

    "Route Middleware & group level" => "code... (middleware.js)",

    "Install MongoDB" => "Download Mongo compass",

    "MongoDB Basic" => "It nosql database || data store in collection || It have not row and column || data store in the form of object || commands : show dba || use database-name || db.createCollection('collection-name') || db.collection-name.drop() || show collections || db.dropDatabase()",

    "MongoDB Curd Operation" => "
        db.collection-name.insertOne({name : 'mani'})
        db.collection-name.find()
        db.collection-name.updateOne({where-fiels:'value'},{($)set:{name:'neel'}})
        db.collection-name.deleteOne({where-fiels:'value'})
    ",

    "Connect MongoDB with Node js" => "npm i mongodb || code... (connect-mongo-basic.js)",

    "Read Data from MongoDB ADVANCE" => "code... (connect-mongo-basic.js)",

    "Insert Data in MongoDB" => "code... (connect-mongo-basic.js)",

    "Update Data in MongoDB" => "code... (connect-mongo-basic.js)",

    "Delete Record in MongoDB" => "code... (connect-mongo-basic.js)",

    "GET & POST & UPDATE & DELETE API with MongoDB" => "code... (basic-api.js)",

    "Mongoose with node CRUD ADVANCE" => "It Give some advance features || code... (mongo-crud-advance.js)",

    "CRUD api with mongoose" => "",

    "Search with multiple field" =>  "code... (search-mongoos.js)",

    "Upload File" => "code... (upload-file.js)",

    "OS module" => " for get operating system info
        const os = require('os')
    ",

    "Events and Event Emitter" => "
        const EventEmitter = require('events')
        const event = new EventEmitter();
        event.on('countAPI',()=>{

        })
        event.emit('countAPI')
    ",

    "REPL - Read-Eval-Print-Loop" => "enter node in command line and enter",

    "Callback hell" => "Pyramid of Doom || a situation in JavaScript where multiple nested callbacks create || Nested setTimeOut best example || avoid callback hell ==> use Promises, Async/Await, ",

    "Streams & buffer" => "Buffer is a built-in class that provides a way to work with binary data directly in memory || streaming refers to a mechanism that allows you to efficiently read or write data in chunks, rather than loading the entire dataset into memory at once || 4 type Readable Streams, Writable Streams, Duplex Streams, Transform Streams || read, write ( data, end, error, finish ) || let readStream = fs.createReadStream('file-name') || readStream.on('data',(chunkData)=>{ })",

    "concept of Object-Relational Mapping" => "Object-Relational Mapping (ORM) is a programming technique that allows developers to interact with a relational database using an object-oriented programming || Entities,Mapping,Tables and Classes,CRUD Operations,Relationships etc",

    "load balancing" => "Load balancing is a technique used in computing and networking to distribute incoming network traffic or computational workload across multiple servers or resources",

    "Authentication and Authorization" => "Authentication is the process of verifying the identity of a user || Authorization is the process of determining what actions or resources a user,",

    "Scalability and Performance" => "Scalability refers to the ability of a system to handle an increasing amount of work || Best Practices ===> Optimized Code || Caching || Load Balancing || Database Optimization || ",

    "Microservices Architecture" => "",

    "Serverless Computing" => "In a serverless architecture, developers focus on writing code in the form of small, event-driven functions, and the cloud provider takes care of automatically managing the infrastructure, scaling, and execution of those functions",

   "event-driven architecture of Node.js" => "In an event-driven architecture, the flow of the program is determined by events such as user actions, sensor outputs, or messages from other programs",

   "What is the difference between require and import in Node.js" => "require is the traditional way of importing modules in Node.js using CommonJS, while import is the more modern and standardized approach introduced with ECMAScript modules. The choice between them depends on the version of Node.js you are using and your project's module system preferences",

   "Explain callback functions in Node.js" => "Callbacks are a fundamental concept in asynchronous programming, allowing functions to be used in a non-blocking manner || A callback is a function called after a given task. This prevents any blocking and enables other code to run in the meantime || Callbacks are functions passed as arguments to other functions",

   "How does clustering work in Node.js" => "Clustering in Node.js refers to the ability to create multiple instances (workers) of a Node.js process that can run concurrently || Cluster Module || Worker Processes || Load Balancing || Communication Between Master and Workers",

   "WebSocket" => "WebSockets are a communication protocol that provides full-duplex communication channels over a single, long-lived connection.",

   "What is JWT (JSON Web Token) and how is it used in Node.js" => "It is commonly used for authentication and authorization purposes in web development || Passing information between parties in a URL, header, or within an HTTP request's body || ",

   "How can you secure a Node.js application" => "Update Dependencies || Use the Latest Node.js Versions || nput validation, proper error handling || Enable HTTPS || CSRF || Secure File Uploads || Security Headers || XSS",

   "What is GraphQL and how does it relate to Node.js" => "",   

   "Docker and Containerization" => "",

   "child_process" => "Helpfull for make multi thread || Child processes in Node.js are useful for tasks that can be parallelized, such as running external scripts, handling CPU-intensive operations, or creating separate processes for different parts of an application || spawn() || exec() || execFile() || fork()",

   "Garbage Collection & Memory Leaks" => "Garbage collection is the process of automatically identifying and reclaiming memory that is no longer in use by the program || Memory leaks occur when references to objects are unintentionally retained",

   "Event-loop, event-driven, non-blocking I/O model" => "webapis ===> callbackqueue ===> Call stack || The event loop continuously checks for events (such as I/O operations, timers, or incoming requests) and executes associated callback functions || An event-driven architecture, the flow of the program is determined by events such as user actions || In a non-blocking I/O model, the program doesn't wait for I/O operations",

   "Connection pooling" => "Connection pooling is a technique used in database applications to manage and reuse database connections, improving performance and efficiency. ",

   "process.nextTick and setImmediate and setTimeout" => "first call ===> nextTick, setTimeout if(time = 0),setImmediate",

   "How can you prevent a module from being cached in Node.js" => "Clearing the Module Cache { delete require.cache[require.resolve('./yourModule')]; } ||  Using a Function Wrapper || Use a Dynamic Import",

   "Explain the difference between exports and module.exports" => "module.exports alway return || module.exports is the actual object returned by a require call || If you assign a new value to module.exports, it replaces the entire exports object.", 

   "URL module in Node.js" => "You can parse URLs using the url.parse() method. It breaks down a URL string into its components (protocol, hostname, port, path, query, etc.).",

   "Control flow function" => "Sequential Execution || Conditional Statements || Loops || Switch Statement || Error Handling || Asynchronous Control Flow",

   "Reactor pattern" => "Design pattern || It is a way to handle multiple asynchronous I/O operations concurrently without the need for multiple threads.",

   "Test pyramid" => "UI test, End to end, integration, unit test case",

   "Purpose of NODE_ENV" => "ou can access the value of NODE_ENV using process.env.NODE_ENV",

   "What is WASI" => "WebAssembly System Interface",

   "First-class function in Javascript" => "Which means they can be treated like any other variable",

   "stub in Node.js" => "...",

   "Libuv" => "Provides the core functionality for asynchronous I/O operations, event loops, and other essential features",

   "ESLint" => "It helps enforce coding standards and best practices",

   "How does Node.js handle the child threads" => "By creating separate instances of the Node.js runtime environment that can be used to execute code in parallel with the main process.",

   "thread pool" => "A thread pool is a collection of threads that are used to execute tasks in parallel.",

   "How are worker threads different from clusters" => "While clusters create multiple instances of a Node.js process, each running on a separate CPU core, worker threads provide a way to create multiple threads within a single process.",

   "How to measure the performance of async operations" => "console.time() and console.timeEnd()",

   "What is meant by tracing in Node.js" => "To profile the performance of an application",

   "crypto module" => "To generate secure random numbers",

   "Passport in Node.js" => "Passport is a popular authentication middleware for Node.js",

   "Cryptography" => "...",

   "Does Node.js provide any Debugger" => "...",
        
   "Reverse proxy" => ""

];



//WORK ON THAT : [ clustering ], [ child_process ], [ WebSockets ]



 
//https://www.simplilearn.com/tutorials/nodejs-tutorial/nodejs-interview-questions

include('bottom.php');