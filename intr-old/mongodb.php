<?php
$array = [ 
    "MongoDB" => "Schemaless || Highly scalable || database ===> collection ===> document",
    
    "Install MongoDB in window" => "...",

    "Install MongoDB in linux" => "...",

    "create database" => "use database-name || db.collection-name || db.collection-name.insertOne({name:'mani'}) || db.createCollection('collection-name')",

    "Embedded documents (Nested documents)" => "",

    "CRUD Operations" => "...",

    "Find vs FindOne" => 'db.collection.find({field:value}) || db.collection.find({field:{ $lt:value } }) || db.collection.find({field:{ $lte:value } }) || db.collection.find({field:{ $gte:value } }) || db.collection.find({field:{ $lt:value , $gt:value } }) || printjson()',

    "Insert vs InsertOne vs InsertMany" => "",

    "UpdateOne vs UpdateMany" => 'db.collection.updateOne({find-field:find-value},{ $set:{update-field:update-value}})',

    "DeleteOne vs DeleteMany" => "db.collection.deleteOne({find-field:find-value})",

    "Select Column (Projection)" => "db.collection.find({},{name:1}) ===> select only name field value",

    "Is MongoDB really Schemaless" => "",

    "Datatypes" => "new date() || new Timestamp()",

    "How to delete database & collection" => "db.collection.drop() || db.dropDatabase()",

    "Ordered option in insert command" => "db.collection-name.insertMany([{name:'mani'}],{ordered:false}) || insert all if face any issue in insertion",

    "Schema Validation" => "Custom code check in chatgpt || by mongoose",

    "Writeconcern in MongoDB" => "db.collection-name.insertMany([{name:'mani'}],{ordered:false, writeConcern:{w:0,j:true,wtimeout:2000}} )",

    "Atomicity" => "",

    "Import json in MongoDB" => "MongoImport",

    "Comparison operators in MongoDB" => '$eq, $ne, $lt, $gt, $lte, $gte, $in & $nin',

    "Logical Operators" => '$not, $and, $or & $nor || db.collection.find({ $or : [{ age:{ $gt:3 }},{ age:{ $lt:30 }} ] })',

    'Element query opeator' => '$exists and $type || db.collection-name.find({ field-name : { $exists : true } })',

    "MongoDB Queries with Evaluation Operators" => '$expr, $mod, $regex, $text  || db.collection.createIndex({ field : "text" }) || db.collection-name.find({ $text : { $search : "search-text" } })',

    "Querying Arrays" => '$size, $all, $elemMatch',

    "Sort" => "db.collection-name.find().sort( {field-name:1} )",

    "Operator" => '$inc, $min, $max, $mul, $unset, $rename & Upsert',

    "Update Nested Arrays" => '$pop, $pull, $push and $addToSet',

    "Indexing" => 'Single Field Index || Compound Index || Text Index || db.collection.createIndex({ fieldName: 1 }) || db.collection.createIndex({ field1: 1, field2: -1 }) || db.collection.createIndex({ content: "text" }) ',

    "Aggrigation" => 'process execution in the form of pipeline',

    '$bucket' => 'It like a chunk of data || groupBy || boundaries || default || output ',

    '$lookup' => 'perform a left outer join between documents || from || localField || foreignField || as',

    '$project' => 'To shape document || rename field',

    'Capped Collection' => 'Set the limit of the documents || db.createCollection("myCappedCollection", { capped: true, size: 1000000, max: 1000 }) || not possible to create existing collection to cap collection, Just drop and do!!',

    'Authentication & Autharization' => '...',

    'Replication & Sharding' => 'Replication ===> copy data || Sharding ===> made multiole server',

    'Replicate example' => '...',

    'Transactions' => '...',

    'Date Queries' => '$year, $month, $dateToString',

    'Managed & Unmanaged Database' => '...'




 
];

 
 

include('bottom.php');