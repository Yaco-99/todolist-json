<?php
    if(isset($_POST['submit'])){
        foreach($_POST['task'] as $task)
        {
        $file= '../data/task.json';
        $current = file_get_contents($file);
        $current = json_decode($current, TRUE);
        for($i=0;$i<sizeof($current);$i++){
            $current[$i]['task'] == $task ? $index=$i : $index;
        }
        $current[$index]['toDo']=false;
        $json = json_encode($current);
        file_put_contents($file, $json);  
        }
    }
?>