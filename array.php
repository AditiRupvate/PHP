<!DOCTYPE html>
<html>
<head>
  <title>array</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body>
<?php

$array2=array("hello","hello2","hello3");

echo " indexed array : ";
echo $array2[0] . " ";
echo $array2[1] . " ";
echo $array2[2] . " ";


$array3=array("key1"=>"value1","key2"=>"value2","key3"=>"value3");

echo "<br>";
echo "<br>";

echo " associative array : ";
echo $array3["key1"] . " ";
echo $array3["key2"] . " ";
echo $array3["key3"] . " ";


?>




</body>
</html>
