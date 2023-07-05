<?php
    $dsn="mysql:host=localhost;charset=utf8;dbname=rank";
    $pdo=new PDO($dsn,"root","");

    if(!empty($_POST['time'])){
    $sql="select count(*) from `rank` where `time`<={$_POST['time']}";
    $check=$pdo->query($sql)->fetchColumn();
    if($check<10){
        $check++;
        $sql="INSERT INTO `rank`(`name`, `time`) VALUES ('{$_POST['name']}','{$_POST['time']}')";
        $pdo->exec($sql);
        $pdo->exec("DELETE FROM `rank` WHERE 1 ORDER BY time DESC LIMIT 1");
    }
}


    $rows=$pdo->query("select * from `rank` order by `time` limit 10")->fetchAll();
    foreach($rows as $row){
        $tmp[]=["name"=>$row['name'],"time"=>$row['time']];
    }


    echo json_encode($tmp);
?>