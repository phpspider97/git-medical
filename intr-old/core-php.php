<?php
$array = [ 
    "$ & $$" =>"",
    "array_merge vs array_combine" => 'array_merge($arr1,$arr2) || array_combine($key,$value)',
    "Difference between If and Swith" => "Direct jumping in switch || use break in switch || for multiple condition use if || Switch more faster || break 2 ( mean execution break for parent loop and so on)",
    "Difference Between CONST and DEFINE" => "DEFINE make in run time but CONST not",
    "SQL Injection" => "",
    "Types of Storage Engines or table type" => "mostly used innodb ( it use commit and rollback ) & myisam",
    "isset() and empty()" => "...",
    "unset() and null" => "...",
    "autoloading" => "",
    "How can you secure your PHP sessions from attacks" => "",
    "What is Cross-Site Scripting (XSS), and how can you prevent it in PHP" => "",
    "use of opcode caching in PHP" => "",
    "do-while and while loop" => "",
    "for and foreach" => "for-> more control over the loop conditions || foreach-> you are iterating over elements in an array.",
    "How to get header" => "getallheaders()"
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
        <a href="https://chatgpt.com/c/6a6909c0-3ecc-83ee-b56e-99294bea4d24" 
           target="_blank" 
           class="resource-btn chatgpt">
           Open ChatGPT →
        </a>
    </div>
    <div class="resource-item">
        <span class="resource-title">▶️ YouTube</span>
        <a href="https://www.youtube.com/watch?v=D4DXbRsQAOA&list=PL8p2I9GklV44cSOlKzB_0TrzxEgwfvicK" 
           target="_blank" 
           class="resource-btn youtube">
           Watch Video →
        </a>
    </div>
</div>