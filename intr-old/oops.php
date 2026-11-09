<?php
$array = [ 

    "Introduction" => "Object oriented programing || Class || Object || Property || Method || Public || Private || Protected || class Abc{}",

    "Constructor" => "__construct(){} || new abc('any-name')",

    "Inheritance" => "Class1 extends Class2{ } || Base class || Drived class",

    "Access Modifier" => "Public || Private || Protected",

    "Overriding Properties & Methods" => "Same method or property use in base and drived class",

    "Abstract Class" => "abstract classes provide a way to define common functionality and structure for a group of related classes while allowing for variability in their implementations || Abstract classes in PHP help define a common interface for a group of related classes || Not to make any object of this type of class, used by make it drived class || abstract class abc{} || make some abstract method comparsory { abstract protected function abc() } || 3 rules",

    "Interfaces" => "Multiple classes inherite in single class || property not define in interface || not make any object || implement in drive class only || interface A{} || interface B{} || class C implements A,B{ }",

    "Static Members" => "can be accessed without creating an instance of the class. || It use without to make object || public static abc='hi' Class-name::abc || replace this with self || use when parent property is use in child parent::abc ",

    "Late Static Binding" => "the value of self refers to the class in which the method is defined, while the value of static refers to the class in which the method is called || static::abc in parent class || use variable in the child class",

    "Traits" => "Use function in the multiple class || trait abc{ } class xyz{ use abc; }",

    "Method Overriding" => "In trait same method then priority to parent class class abc{ use trait1, trait2{ trait1::function-name insteadof trait2 } }",

    "Type Hinting" => 'function abc(int $variable){ } || int, float, string, bool, array, class, object',

    "Namespace" => 'A namespace is a way to encapsulate items, such as classes, functions, and constants, to avoid naming conflicts between different parts of a program.  || namespace abc; class xyz{} || $obj = new abc\xyz()',

    "Method Chaining" => '$obj = new class-name{ } || $obj->function1()->function2()->function3() || return $this',

    "Magic Methods" => "__construct() || __destruct() || __get() || __set() || __isset() || __unset() || __autoload() || __clone() || __sleep() || __wakeup() || __call() || __callStatic() || __toString() || __invoke()",

    "__Destruct()" => "public function __destruct(){ }",

    "__Autoload()" => 'function __autoload($class){ require "class/".$class.".php" } || when create object it call',

    "__Get()" => "When get private and non-existing property",

    "__Set()" => 'When set private and non-existing property || __Set($property, $value)',

    "__Call()" => "When get private and non-existing method",

    "__CallStatic()" => "When get private and non-existing static method",

    "__Isset()" => 'Check is private property is set or not public function __Isset($property){ }',

    "__Unset()" => 'When unset private property unset($obj->property) || __Unset($property){ unset($this->property) }',

    "__toString()" => "When echo object",

    "__Sleep()" => "When serialize class-object || serialize ==> convert object to array",

    "__Wakeup()" => "When unserialize class-object || unserialize ==> convert array to object",

    "__Clone()" => 'Copy by value || Copy by reference & || Clone help to copy by value || $var1 = clone $var2 || when object variable define then copy by reference execute || __Clone(){ } it helpfull in sub-obj value change',

    "__Invoke()" => "When make object as a function",

    "Constants" => "__LINE__, __FILE__, __DIR__, __FUNCTION__, __CLASS__, __METHOD__, __NAMESPACE__, __TRAIT__",

    "Conditional Functions" => " class_exists(), interface_exists(), method_exists(), trait_exists(), property_exists(), is_a(), is_subclass_of()",

    "encapsulation" => "It refers to the bundling of data || Encapsulation is achieved by using access modifiers such as public, private, and protected to control the visibility of properties and methods.",

    "polymorphism" => "Mean many form || function name is same but it's behaviour is different in class",

    "final keyword" => "Apply restriction on class, method, or variable so cannot be further extended, overridden, or modified",
    
    "Coupling" => "coupling refers to the degree of interconnectedness between classes or modules. It describes how much one class or module knows about or depends on another || Loose Coupling || Tight Coupling",
    
    "Over loading by call method and overridding" => "Over loading : use multiple methode with same name but different parameter achieve by _call methos or optional parameter || overridding : same methode in both class in inheritance",

    "Password_hash, password_varify" => "Password_hash : convert password to non raldable form || password_varify : check enter password is correct",

    "Design patter singlton, factory, observal, mvc " => "singlton: only one instance use static method for create instance || factory: not expose object create static class and return object || observal: one to many relation like youtube upload video than send notidication to all subscriber example",

    "Anonymous class" => "Anonymous classes are often used in situations where you don't need to refer to the class by name later in the code || Anonymous classes are useful in scenarios where you want to create a class for a specific purpose without the need to reference it elsewhere in the code.",

    "Clouser and anonymous function " => "A closure is a special kind of anonymous function that can capture variables from the surrounding scope || An anonymous function, also known as a lambda function, is a function without a specified name ",

    //"Reflection" => "No need...",

    "What is composition and aggregation" => "Composition ===> It is an alternative to inheritance (Tightly copuple ) || Aggregation ===> Way to represent relationships between classes where one class contains instances of another class, and the contained instances can exist independently. (Loosly copuple )",

    "main pillars of OOP" => "{encapsulation, inheritance, polymorphism, and abstraction}",

    "is-a relationship" => "The is-a relationship implies that an object of the subclass is also an object of the superclass",

    "Autoloading" => "spl_autoload_register('function-name')",

    "Exception & ErrorException & Throwable" => "Exception : send maual error by throw || ErrorException: like php error warning and notice like that || Throwable use for display both error",

    "set_exception_handler" => "set_exception_handler('function-name')",

    "Parent keyword" => "Helpful to call a method from its parent class || parent::myMethod2()",

    "SOLID Principles" => "Single Responsibility Principle, Open/Closed, Liskov Substitution, Interface Segregation , Dependency Inversion"
    
        
];

//WORK ON THAT : [ Clone || * ], [ SOLID || * ], [ Design patter || * ]

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
        <a href="https://chatgpt.com/c/6a2ef0e2-390c-83ee-957e-9deeed8c6c70" 
           target="_blank" 
           class="resource-btn chatgpt">
           Open ChatGPT →
        </a>
    </div>
    <div class="resource-item">
        <span class="resource-title">▶️ YouTube</span>
        <a href="https://www.youtube.com/watch?v=MVEAYafrgKM&list=PL0b6OzIxLPbwoi6Urr4LZTz2AMMCtzqDt" 
           target="_blank" 
           class="resource-btn youtube">
           Watch Video →
        </a>
    </div>
</div>
 