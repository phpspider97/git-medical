<?php
$array = [ 
    "what is Laravel" => "php framework",

    "MVC" => "Model view controller",

    "Folder and file structure" => "...",

    "Routing" => "web.php, api.php",

    "Controller" => "php artisan make:controller controller-name",

    "Component" => "...",

    "URL generation" => "URL::to('route-path')",

    "Middleware" => "Middleware is a mechanism that allows you to filter HTTP requests. It provides a convenient way to perform actions before or after the HTTP request || Group, route, global || php artisan make:middleware middleware-name",

    "Http Client" => "Facades/HTTP || HTTP::get('url')",

    "Http Request Methods" => "Get, put, post, delete",

    "Session & flash session" => '$req->session()->put("key","value")',

    "File upload" => '$req->file("file-name")->store("folder-name")',

    "Localization" => "Use multiple language || resources/lang",

    "CRUD by model" => "...",

    "JOIN" => "->join('table2','table2-field','=','table1','table1-field')->get()",

    "Migration & it's command" => "php artisan make:migration create_users_table || php artisan make:migrate || php artisan migrate:rollback || php artisan migrate:refresh",

    "Eloquent ORM" => "An ORM is a technique that lets you interact with your database in an object-oriented way || Eloquent follows the MVC architecture || Eloquent allows you to define relationships between different models || Eloquent supports soft delete & automatically manages timestamps",

    "Accessors & Mutator" => 'In model getNameAtribute($value){ return $this->attribute["name"] = $value } || setNameAtribute($value){ return $this->attribute["name:] = $value  }',

    "Relationship" => "code...",

    "Fluent Strings" => 'Str::of($string)->ucFirst($string)',

    "Route Model Binding" => '(ModelName $data){ } || get("path/{key:field-name}")',

    "Validation" => "code... || for make rule php artisan make:request StoreProductRequest",

    "Make Custom Command" => "code...",

    "Laravel Lifecycle" => "public/index.php ==> bootstrap/app.php ==> app/http/kernel.php ==> router ==> controller ==> public/index.php",

    "Dependency Injection" => "Dependency Injection is the process of providing the dependencies of a class from the outside. || constructor, settor, interface || code...",

    "Query log" => "DB::enableQueryLog(); || DB::getQueryLog()",

    "API rate limit" => "You can implement API rate limiting to control the number of requests a user can make to your API within a specified time period || Laravel provides a built-in middleware called throttle",

    "Encrypt and decrypt" => "use Illuminate\Support\Facades\Crypt || Crypt::encryptString('data') || Crypt::decryptString('data')",

    "Facade" => "Facade is a design pattern that provides a simple and static-like interface to a class || Facades provide a static interface to the services available in the service container || illuminate/support/facade || easy to use and not need dependency injection",

    "Service container" => "The Laravel service container is a central part of the framework that enables dependency injection || It is used for managing class dependencies and performing dependency injection. The service container binds classes or interfaces to concrete implementations and resolves these dependencies when needed.",

    "Service Providers" => "Service providers are responsible for binding classes in the service container. They are registered in the config/app.php file and contain methods like register and boot",

    "Query builder" => "Laravel Query Builder is a set of classes and methods provided by the Laravel framework that allows you to interact with databases || DB::table() || chunking",

    "Soft delete" => "use softdelete in model || deleted_at field in table",

    "Name route" => 'Route::get("/profile", "UserController@showProfile")->name("profile") || $url = route("profile") || redirect()->route("profile") || <a href="{{ route("profile") }}">Visit Profile</a>',

    "clouser" => "Anomyous function and used as a parameter in a function",

    "Reverse routing" => "HTML::link_to_action('UserController@showProfile')",

    "Use of trait" => "laravel not support multiple inheritance",

    "Autoload and Autoloader" => "...",

    "Serialization" => "Convert one datatype to another || convert array to json",

    "Helper file" => "Use globaly || create in helper.php file in app folder and add in composer.json in files section || composer dump-autoload",

    "Bootstrap directory" => "Handel service container, facades, middleware, service provider and kernel",

    "Observer" => "Like a event and listener",

    "Microservice architecture" => "...",

    "Gates and Policies" => "",

    "Job and Queues" => "Laravel's job and queue system is a powerful way to offload time-consuming tasks || A Job in Laravel is a class that encapsulates a unit of work. It represents a task that should be performed asynchronously || Queues in Laravel are a mechanism for delaying the execution of tasks ",

    "Events and Listeners" => "php artisan event:generate || php artisan make:event EventName|| php artisan make:listener ListenerName --event=EventName",

    "Broadcasting" => "This is particularly useful for building interactive, real-time features in your application, such as chat applications, notifications, or live updates.",

    "Caching" => "Caching is a technique used to store and retrieve data in a faster manner by storing it in a temporary storage location || Cache::put('key', 'value', 60) || Cache::get('key')",
 
    "Eager loading & lazy loading" => "Eager loading resolved n+1 query it use {with} || lazy loading simple i use",

    "What is collection" => 'A collection is an object-oriented wrapper around PHP arrays || Laravel collections provide a fluent, convenient way to work with arrays of data. Collections offer a wide range of methods to manipulate, filter, and iterate over the data || $collection = collect([1, 2, 3, 4, 5]);',

    "fresh()" => "It only retrieves the latest data || The fresh method is used to reload a model instance with fresh data from the database.",

    "Invokable controller" => "__invokable() || only one method",

    "Route cache" => "php artisan route:cache || to improve speed in route || store in file || php artisan cache:clear",

    "View cache" => "php artisan view:cache || php artisan view:clear",

    "After insert get id" => "DB::table('abc')->insertGetId(['name'=>'neel'])",

    "Insert or update record" => "upsert()",

    "Chunk() & lazy()" => "Chunk ==> get some part of data and that data process by clouser method || lazy similar to chunk but it not use clouser",

    "paginate() & cursorPaginate" => "paginate working on primary key || cursorPaginate ==> usefull in order by and orderBy is mandatory",

    "Directive method" => "@method('PUT') || @method('DELETE')",

    "Breeze "   => "display login, registration form", 

    "Cashier"   => "payment gateway",

    "Dusk"   => "browser testing",

    "Envoy"  => "run remote servers task by shell",

    "Fortify" => "implement authentication and authorization features",

    "Folio" => "generating a route by create page",

    "Homestead" => "development environment without requiring you to install PHP",

    "Horizon" => "provides a beautiful dashboard",

    "Jetstream" => "login, registration, email verification, two-factor authentication",

    "Mix" => "It simplifies the process of working with CSS, JavaScript",

    "Octane" => "application's performance",

    "Passport" => "provides a full OAuth2",

    "Pennant" => "",

    "Pint" => "your code style stays clean and consistent",

    "Precognition" => "validation for your frontend JavaScript application",

    "Prompts" => "for adding beautiful and user-friendly forms to your command-line applications",

    "Pulse" => "track slow jobs and endpoints, find your most active users, and more",

    "Sail" => "interacting with Laravel's default Docker development environment",

    "Sanctum" => "authentication system for SPA",

    "Scout" => "adding full-text search to your Eloquent models",

    "Socialite" => "supports authentication via Facebook, Twitter, LinkedIn, Google, GitHub, GitLab, Bitbucket, and Slack",

    "Telescope" => "Telescope provides insight into the requests coming into your application, exceptions, log entries, database queries, queued jobs, mail, notifications, cache operations, scheduled tasks, variable dumps, and more",

    "Valet" => "development environment for macOS"





];
 

include('bottom.php');


?>

<style>
.resource-box {
    background:#f8f9fa;
    padding:20px;
    border-radius:15px;
    margin:20px 0;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}
.resource-item {
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 20px;
    margin-bottom:12px;
    background:white;
    border-radius:12px;
    border-left:5px solid #0d6efd;
    transition:.3s;
}
.resource-item:hover {
    transform:translateX(5px);
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}
.resource-title {
    font-size:18px;
    font-weight:700;
    color:#343a40;
}
.resource-btn {
    padding:10px 18px;
    border-radius:25px;
    text-decoration:none;
    color:white;
    font-weight:600;
    transition:.3s;
}
.chatgpt {
    background:linear-gradient(135deg,#10a37f,#087f63);
}
.youtube {
    background:linear-gradient(135deg,#ff0000,#cc0000);
}
.resource-btn:hover {
    color:white;
    transform:scale(1.05);
}
</style>
<div class="resource-box">
    <div class="resource-item">
        <span class="resource-title">🤖 ChatGPT</span>
        <a href="https://chatgpt.com/c/6a69b9a3-25b4-83ee-8022-997a95e7032c" 
           target="_blank" 
           class="resource-btn chatgpt">
           Open ChatGPT →
        </a>
    </div>
    <div class="resource-item">
        <span class="resource-title">▶️ YouTube</span>
        <a href="https://www.youtube.com/watch?v=_UoBJDWKQbw&list=PL8p2I9GklV45jJzLsexf2_hNNafpCXw9k" 
           target="_blank" 
           class="resource-btn youtube">
           Watch Video →
        </a>
    </div>
</div>