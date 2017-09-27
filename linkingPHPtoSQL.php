<?php
$db = new PDO('mysql:host=127.0.0.1;dbname=families', 'root');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


$query = $db->prepare(
    "SELECT `children`. `name` 
FROM `children` 
INNER JOIN `colors`
ON `children`.`f_color` = `colors`.`id`
WHERE `colors`.`color` = 'red';
");

$query->execute();

$result = $query->fetchAll();

var_dump($result);

echo("<br>");

$query2 = $db->prepare(
    "SELECT `children`.`name` 
FROM `children`
INNER JOIN `adults` 
ON `children`.`id` = `adults`.`child1`
WHERE `adults`.`pet_name` = 'Syd'
GROUP BY `children`.`name`;
");

$query2->execute();

$result2 = $query2->fetchAll();

var_dump($result2);

echo("<br>");

$query3 = $db->prepare(
    "SELECT `children`.`name`, `adults`.`pet_name`
FROM `children`
INNER JOIN `adults` 
ON `children`.`id` = `adults`.`child1`
WHERE `adults`.`DOB` > '1985-01-01';
");

$query3->execute();

$result3 = $query3->fetchAll();

var_dump($result3);

echo("<br>");

$query4 = $db->prepare(
    "SELECT `colors`.`color`
FROM `colors`
INNER JOIN `children` 
ON `colors`.`id` = `children`.`f_color`
JOIN `adults`
ON `children`.`id` = `adults`.`child1`
WHERE `adults`.`DOB` >= '1991-01-01'
GROUP BY f_color 
ORDER BY COUNT(f_color) DESC LIMIT 1;
");

$query4->execute();

$result4 = $query4->fetchAll();

var_dump($result4);

