<?php
//Sets up connection to database -> Needed on every page which uses the database
$db = new PDO('mysql:host=127.0.0.1;dbname=families', 'root', '');

//THIS SETS THE DEFAULT FETCH MODE FOR ALL QUERIES TO FETCH_ASSOC
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$query = $db->prepare("INSERT INTO adults (`name`) VALUES (`bob`);");
$query->execute();

$query2 = $db->prepare("SELECT `name` FROM `adults`;");
$query2->execute();

//You can specify how the data is returned
$result = $query2->fetchAll(); //Another method is fetch(); just returns one row


//DIFFERENT TYPES OF RETURN

$query3 = $db->prepare("INSERT INTO adults (`name`) VALUES (`bob`);");
$result = $query3->fetch(PDO::FETCH_BOTH);

echo $result[0]; //WILL RETURN BOB
echo $result['name']; //THESE TWO ECHO'S WILL BE THE SAME, FETCH BOTH RETURNS THE INDEXED ARRAY KEY AND THE ASSOCIATIVE ARRAY KEY

//ALTERNATIVE RETURN TYPE

$query3 = $db->prepare("SELECT `name` FROM `adults`;");
$result = $query3->fetch(PDO::FETCH_ASSOC); //ONLY RETURNS ASSOCIATIVE ARRAY KEY

echo $result['name']; //IS THE ONLY ECHO THAT WILL WORK

//ANOTHER ALTERNATIVE RETURN TYPE
$query4 = $db->prepare("SELECT `name` FROM `adults`;");
$result = $query4->fetch(PDO::FETCH_OBJ);

echo $result->name;


//FINAL ALTERNATIVE TYPE

$query5 = $db->prepare("SELECT `name` FROM `adults`;");
$result = $query5->fetch(PDO::FETCH_CLASS, 'ClassName'); //Defines which class you want the object to be based on
//CLASS HAS TO HAVE PROPERTIES THAT MATCH THE FIELD TYPE

echo $result->name;

//fetchall() HAS ALL THE SAME RETURN TYPES EXCEPT FETCH_OBJ AND FETCH_CLASS
$query5 = $db->prepare("SELECT `name` FROM `adults`;");
$result = $query5->fetchAll(PDO::FETCH_ASSOC);

echo $result[0]['name']; //MULTIDIMENSONAL ARRAY, INDEXED ARRAY OF ASSOCIATIVE ARRAYS


// CAN DO $query->setFetchMode(PDO::FETCH_CLASS, 'CLASSNAME')), ALL FETCHS WILL HAVE THIS TYPE

// BETTER WAY OF DOING THIS $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);