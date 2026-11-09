<?php
$array = [ 
    "Introduction" => "Inhance version of javascript || not directly run on browser || check error on compile time || Type validation",


    "Installing and Importance" => "Install node || npm i -g typescript",

    "Installing and Importance" => "Install node || npm i -g typescript || tsc file-name",

    "Setting Up Editor" => "VS code",

    "Make First Program" => "const abc:number = 12 || directly ts file not run in browser first convert into js file",

    "Core Data Types" => "number (1,1.2,3), string, boolean || const abc:number = 12 || const abc:string = '12'",

    "TypeScript vs JavaScript" => "in javascript add typeof (if(typeof abc === 'number')) validation but in typescript just add :number",

    "Type inference" => "idea of type || if i assign type of variable then next time assign same variable it idea from previous || let data:5 then only assign number 5",

    "Object Type" => "type objType = { name:string } || const obj1:objType = { name:'mani'}",

    "Array Type" => "let arr:string[] = [1,2,3] || let arr:[string,number,number] = [1,2,3] || let arr:any[] = [1,2,3]",

    "Tuple Type" => "It just like a array but more advance || define length || let arr:[string,number,number?] = [1,2,3]",

    "Enum" => "Group of constant || enum Role [ ADMIN,MANAGER ] || console.log(Role)",

    "Any type" => "let data:any=10 || let data:any[]=[10] ",

    "Union" => "Define multiple type || let data:string|number=10",

    "Literals type" => "like union type || let data:10|20 directly define value",

    "Alias" => "type abc = string|number || let a:abc=10, let b:abc='neel'",

    "Function type" => "which type of value return is called function type || function abc():number{ }",

    "Void function" => "Nothing || totaly blank || function abc():void{ let abc=10 } return undefined",

    "Unknown type" => "similar to any but it more suitable || let data:unknown let abc:string abc=data (not possible) ",

    "Never Type" => "when function return error",

    "Compile and Use Multiple Files" => "tsc -init ==> tsc -w",

    "Include and Exclude file folder" => "['exclude'=>'file-name,'*/file-name''] || ['include'=>'file-name'] in tsconfig.json",

    "Target configuration" => "target property in tsconfig.json",

    "rootDir and outDir" => "send one directory file to another and converted format",

    "Code Quality improvement Options" => "nounusedlocals in tsconfig.json file etc",

    "Class" => "User define with a certain object || same as i know",

    "Class Compilation with ES5 and ES6" => "ES6 same as class define in TS",
 
    "Public and Private access modifiers" => "Its OOPS concept || same as i know",

    "Constructor and Shorthand Initialization" => "constructor(){} || constructor(public name, public email){} ==> Shorthand Initialization",

    "Read only vs private property" => "Not access || access but not change || private || readonly",

    "Inheritance" => "Class1 extend Class2{}",


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
        <a href="https://chatgpt.com/c/6a699a15-1f64-83e8-8492-f5cea2576981" 
           target="_blank" 
           class="resource-btn chatgpt">
           Open ChatGPT →
        </a>
    </div>
    <div class="resource-item">
        <span class="resource-title">▶️ YouTube</span>
        <a href="https://www.youtube.com/watch?v=SVFjgV2F_io&list=PL8p2I9GklV44eT51JPju4LsTQlce6DPtx" 
           target="_blank" 
           class="resource-btn youtube">
           Watch Video →
        </a>
    </div>
</div>