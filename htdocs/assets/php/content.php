<?php
$toDo=[];
$archive=[];
$file= '../data/task.json';
$data = file_get_contents($file);
$data = json_decode($data, TRUE);
foreach($data as $el){
    if($el['toDo']){
        array_push($toDo, $el);
    }else{
        array_push($archive, $el);
    }
}

if(isset($_GET['d'])){
    if($_GET['d']=="todo"){
        foreach($toDo as $task){
            echo "<input class='checkbox' type='checkbox' name='task[]' value='$task[task]'><label class='ml-2' for='task'>$task[task]</label>$,$";
        }
    }else{
        foreach($archive as $task){
            echo "<div><input disabled checked type='checkbox' name='task[]' value='$task[task]'><label class='ml-2 archived' for='task'>$task[task]</label></div>";
        } 
    }
}
?>