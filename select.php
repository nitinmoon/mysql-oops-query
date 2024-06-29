<?php
require_once 'database.php';

$obj = new Database();


$selectData = $obj->select('students', "*", NULL, 'city DESC', '5');

print_r($selectData->id);



