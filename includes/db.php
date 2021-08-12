<?php
$db['DB_HOST'] = "localhost";
$db['DB_USER'] = "root";
$db['DB_PASS'] = "";
$db['DB_NAME'] = "php_cms_edwin";
foreach($db as $key => $value){
    define($key,$value);
}
$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if(!$conn){
    echo "db Connection error";
}
?>