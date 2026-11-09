<?php
$array = [  
    "Introduction" => "DBMS || 2 type relational & nosql",

    "Create Table" => "CREATE TABLE abc( COLUMN1 datatype)",

    "Insert" => "INSERT INTO TABLE_NAME (column1, column2) VALUES (value1, value2) ",

    "Insert multiple rows" => "INSERT INTO TABLE_NAME (column1, column2) VALUES (value1, value2),(value1, value2)",

    "Constraints" => "It's mean restricion || NOT NULL, UNIQUE, DEFAULT, CHECK, PRIMARY KEY, FORIEGN KEY",

    "WHERE" => "",

    "AND, OR, NOT Operators" => "in(), not in()",

    "BETWEEN & NOT BETWEEN" => "age BETWEEN 10 AND 30",

    "LIKE Operator & Wildcards" => "like, no like",

    "Regular Expression" => "where name regexp 'khan$ | poor' ",

    "ORDER BY & DISTINCT" => "",

    "IS NULL & IS NOT NULL" => "",

    "LIMIT & OFFSET" => "LIMIT OFFSET,LIMIT Number",

    "Aggrigate function" => "Count, Sum, Min, Max, Avg",

    "UPDATE" => "",

    "COMMIT & ROLLBACK" => "",

    "DELETE" => "",

    "PRIMARY KEY & FOREIGN KEY" => "In primary not to store null value but in unique store null || Implement primary key only one column",

    "INNER JOIN" => "",

    "LEFT JOIN & RIGHT JOIN" => "",

    "CROSS JOIN" => "",

    "JOIN Multiple Tables" => "",

    "GROUP BY & HAVING" => "Use aggrigate function with group by is mandatory || SELECT columns FROM table_name WHERE condition GROUP BY column_name HAVING condition ORDER BY column_name ASC|DESC",

    "SubQuery with EXISTS & NOT EXISTS" => "Nested Query ==> SELECT columns from table1 where column=(SELECT columns from table2 where condition) || Outer Query ==> SELECT columns from table1 where EXISTS OR NOT EXISTS(SELECT columns from table2 where condition)",

    "UNION & UNION ALL" => "SELECT column1,column2 from table1 UNION/UNION ALL SELECT column1,column2 from table2",

    "IF & CASE Statement" => "SELECT column1,column2 IF(condition, TRUE result, FALSE result) as alias_name FROM table || SELECT column1,column2 CASE WHEN condition1 THEN resutl1 WHEN condition2 THEN resutl2 else result alias END as alias_name FROM table",

    "Arithmetic Functions" => "PI(), ROUND(), CEIL(), FLOOR(), RAND() etc",

    "String Functions" => "CONCAT(), LTRIM(), UPPER(), LENGTH()",

    "Time Functions" => "...",

    "ALTER" => "ALTER table table_name add column_name datatype || ADD, DELETE, MODIFY, CHANGE (For column), RENAME (For table)",

    "VIEW" => "Save query in datbase || CREATE VIEW view_name as QUERY || SELECT * from view_name",

    "INDEX" => "Create serching more fast || CREATE INDEX index_name ON table_name(column_name1,column_name2) || SHOW INDEX FROM table_name",

    "difference between mysqli and PDO" => "",

    "prevent SQL injection" => "Use Parameterized Statements (Prepared Statements) || Use ORM Libraries || Input Validation and Sanitization || Least Privilege Principle",

    "DBMS & RDMBS" => "A DBMS is a software system, An RDBMS is a specific type of DBMS || It provides an interface for defining, creating, and managing databases, In an RDBMS, data is organized into tables with rows and columns, || DBMS may or may not support a relational model. Examples of non-relational DBMS include MongoDB, Redis , Examples of RDBMS include MySQL, PostgreSQL, Oracle Database ",

    "DELETE & DROP & TRUNCATE" => "DELETE is DML but rest id DDL",

    "ACID Property" => "Atomicity || Consistency || Isolation || Durability",

    "SQL Command" => "DML==>select,insert,update,delete || DDL ==> create, alter, drop || DCL ==> Grant, revoke || TCL ==> begon, tran, commit, rollback",

    "Query usefull for dashboard graph" => "SELECT extract(year from Order_date) as years, to_char(Order_date,'Mon') as months,sum(Sales) as TotalSales FROM Products GROUP BY 1,2 ORDER BY TotalSales DESC",

    "Transaction" => "A transaction is a sequence of one or more SQL statements that are executed as a single unit of work. Transactions provide the ACID properties || SQL Statements for Transactions ===> BEGIN TRANSACTION;
    , COMMIT, ROLLBACK, SAVEPOINT savepoint_name, ROLLBACK TO SAVEPOINT savepoint_name", 

    "Triggers" => "A trigger is a set of instructions that are automatically executed in response to certain events on a particular table or view || SQL triggers are typically associated with the INSERT, UPDATE, and DELETE operations on tables",

    "Stored Procedures and Functions" => "",

    "normalization" => "Normalization is a database design technique used to organize tables and relationships in a relational database to reduce redundancy and improve data integrity || 1NF, 2NF, 3NF, BCNF, 4NF, 5NF", 

    "How to optimize a slow-performing MySQL query" => "Use Indexing, Analyze the Query",

    "EXPLAIN statement" => "In SQL, the EXPLAIN statement is used to obtain information about how a SQL query is executed by the database engine || EXPLAIN SELECT * FROM employees WHERE department_id = 10;",

    "partitioning in MySQL" => "partitioning is a database feature that allows you to split large tables into smaller, more manageable pieces called partitions. || RANGE, LIST, HASH, KEY",

    "role of the InnoDB storage engine" => "",

    "How to perform data replication in MySQL" => "Replication in MySQL is the process of copying data from one MySQL database server (called the master) to one or more MySQL database servers (called slaves).",

    "Clustered, non-clustered indexes & covering indexes" => ""

];





//WORK ON THAT : [ Normalization || * ], [ replication || * ], [ connection pooling || * ], [ full-text search || * ]






include('bottom.php');

// Link :
// https://drive.google.com/file/d/1-GHBE5iSGXMbGXtQP0Z3bzoKnXEGJUrK/view?pli=1
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
        <a href="https://chatgpt.com/c/6a68fff3-7200-83e8-add4-98e675a20533" 
           target="_blank" 
           class="resource-btn chatgpt">
           Open ChatGPT →
        </a>
    </div>
    <div class="resource-item">
        <span class="resource-title">▶️ YouTube</span>
        <a href="https://www.youtube.com/watch?v=KlWOr2RwqM4&list=PL0b6OzIxLPbzf12lu5etX_vjN-eUxgxnr" 
           target="_blank" 
           class="resource-btn youtube">
           Watch Video →
        </a>
    </div>
</div>