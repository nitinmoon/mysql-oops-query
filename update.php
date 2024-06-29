<?php
require_once 'database.php';

$obj = new Database();


$updateData = $obj->update('students', ['student_name' => 'Harshal', 'age' => '55', 'city' => 'Dhule'], 'id="7"');

echo $updateData;



