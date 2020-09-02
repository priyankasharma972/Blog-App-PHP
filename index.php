<?php
session_start();
include_once("db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog</title>
</head>
<body>
    <?php
    require_once("nbbc/nbbc.php");

    $bbcode= new BBCode;
    $sql = "SELECT * FROM posts ORDER BY id DESC";
    $res= mysqli_query($db,$sql) or die(mysqli_error());
    $posts="";


    if(mysqli_num_rows($res)>0){
        while($row= mysqli_fetch_assoc($res)){
            $id=$row['id'];
            $title=$row['title'];
            $content=$row['content'];
            $date=$row['date'];
            

            $admin="<div><a href='del_post.php?pid=$id'>DELETE</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href='edit_post.php?pid=$id'>EDIT</a></div>";
            $output= $bbcode->Parse($content);
            $posts .= "<div><h2>$title</a></h2><h4>$date</h4><p>$output</p>$admin<hr /></div>";

        }
        echo $posts;
    }
    else{
        echo "There are no posts to display!<br/><br/><br/>";  
    }

    ?>

    <a href='post.php' target='_blank'>CREATE A NEW POST</a>
</body>
</html>