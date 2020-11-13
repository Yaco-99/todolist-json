<?php
$box=$_GET["box"];
$disable=$_GET["disable"];
$disable=filter_var($disable, FILTER_VALIDATE_BOOLEAN);

$file= '../data/task.json';
$current = file_get_contents($file);
$current = json_decode($current, TRUE);

for($i=0;$i<sizeof($current);$i++){
    $current[$i]['task'] == $box ? $index=$i : $index;
}

$current[$index]['toDo']=$disable;
$json = json_encode($current);
file_put_contents($file, $json);  
?>