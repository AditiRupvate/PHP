<!DOCTYPE html>
<html>
<head>
  <title>array sort</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body>
<?php

$array2=array("hello","hello2","hello3");

echo " indexed array : ";
echo $array2[0] . " ";
echo $array2[1] . " ";
echo $array2[2] . " ";

$sorted=rsort($array2);
echo "<br>";
$length=count($array2);
echo " Reverse sort <br> ";
for ($i=0; $i < $length; $i++)
 { 

echo $array2[$i] . " " ;
  
}


?>




</body>
</html>
