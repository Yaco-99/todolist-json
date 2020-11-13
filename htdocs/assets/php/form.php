<?php
    if(isset($_POST['submit'])){
        $str = filter_var($_POST['task'], FILTER_SANITIZE_STRING);
        $str = str_replace(array("\n","\r"),' ',$str);
        $file= '../data/task.json';
        $current = file_get_contents($file);
        $current = json_decode($current, TRUE);
        $current[] = ['task' => $str, 'toDo' => true];
        $json = json_encode($current);
        file_put_contents($file, $json);
    }
?>