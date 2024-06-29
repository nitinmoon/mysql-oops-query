<?php 

require_once 'database.php';


$obj = new Database();

$saveData = $obj->insert("students", ['student_name' => 'Vikas', 'age' => '44', 'city' => 'Nagpur']);

echo $saveData;


?>