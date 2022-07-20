<?php
include "core/base.php";
$id = $_GET['id'];
$sql = "DELETE FROM contact_list WHERE id=$id";
$query = mysqli_query($conn,$sql);


if($query){
    header("Location:index.php");
}else{
    die("delete error:".mysqli_error($conn));
}

?>