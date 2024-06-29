<?php

require_once 'database.php';

$obj = new Database();

$deleteData = $obj->delete('students', 'id="11"');

echo $deleteData;
