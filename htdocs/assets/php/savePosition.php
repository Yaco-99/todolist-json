<?php

$task=$_GET["task"];
$position=$_GET["position"];

$file= '../data/task.json';
$current = file_get_contents($file);
$current = json_decode($current, TRUE);

for($i=0;$i<sizeof($current);$i++){
    $current[$i]['task'] == $task ? $indexRmv=$i : $index;
    $current[$i]['task'] == $position ? $index=$i : $index;
}
$position == NULL ? $index = sizeof($current) : $index;

array_splice($current, $indexRmv, 1);
array_splice($current, $index, 0, array(['task' => $task, 'toDo' => true]));
echo $index;

$json = json_encode($current);
file_put_contents($file, $json);
?>