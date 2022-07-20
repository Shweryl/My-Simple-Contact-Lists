<?php
include "base.php";

//create start
function contactAdd($name,$email,$phone,$fileName){
    global $conn;
    $sql = "INSERT INTO contact_list (name,email,phone,photo_name) VALUES ('$name','$email','$phone','$fileName')";
    $query = mysqli_query($conn,$sql);
    if($query){
        return true;
    }else{
        die("error".mysqli_error($conn));
    }
}
function register(){
    $name = "";
    $email = "";
    $phone = "";
    $fileName="";
    $tmpFile="";
    $saveFolder="";
    $error_status = 0;

    //name validate
    if(empty($_POST['name'])){
        setError('name',"Name input is required");
        $error_status = 1;
    }else{
        if(strlen($_POST['name']) < 5 ){
            setError('name',"Name is too short");
            $error_status = 1;
        }else{
            if(strlen($_POST['name']) > 20){
                setError('name',"Name is too long");
                $error_status = 1;
            }else{
                if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST['name'])) {
                    setError('name',"Only letters and white space allowed");
                    $error_status = 1;
                }else{
                    $name = textFilter($_POST['name']);
                }
            }
        }
    }
    //email validate
    if(empty($_POST['email'])){
        setError('email',"Email input is required");
        $error_status = 1;
    }else{
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            setError('email',"Email format incorrect");
            $error_status = 1;
        }else{
            $email = textFilter($_POST['email']);
        }
    }
    //phone validate
    if(empty($_POST['phone'])){
        setError('phone',"Phone input is required");
        $error_status = 1;
    }else{
        if(!preg_match("/^[0-9 ]*$/",$_POST['phone'])){
            setError('phone',"Phone format incorrect");
            $error_status = 1;
        }else{
            $phone = textFilter($_POST['phone']);
        }
    }

    //photo validate
    $supportFileType = ['image/png','image/jpeg'];
    if($_FILES['upload']['name']){
        $tmpFile = $_FILES['upload']['tmp_name'];
        $fileName = $_FILES['upload']['name'];
        if(in_array($_FILES['upload']['type'],$supportFileType)){
            $saveFolder = "css/images/";
        }else{
            setError('upload',"Incorrect file..");
            $error_status = 1;
        }
    }else{
        setError('upload',"Image file input is required");
        $error_status = 1;
    }




    if(!$error_status){
        move_uploaded_file($tmpFile,$saveFolder.$fileName);
        if (contactAdd($name, $email, $phone, $fileName)) {
            linkTo('index.php');
        }
    }
}
//create end

function fetchContacts(){
    global $conn;
    $sql = "SELECT * FROM contact_list";
    $query = mysqli_query($conn,$sql);
    $rows = [];
    while($row = mysqli_fetch_assoc($query)){
        array_push($rows,$row);
    }
    return $rows;
}
function fetchContact($id){
    global $conn;
    $sql = "SELECT * FROM contact_list WHERE id=$id";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    return $row;
}

//update start
function updateContact($name,$email,$phone,$fileName,$contactId){
    global $conn;
    $sql = "UPDATE contact_list SET name='$name',email='$email',phone='$phone',photo_name='$fileName' WHERE id='$contactId'";
    $query = mysqli_query($conn,$sql);
    if($query){
        return true;
    }else{
        die("updateContact error".mysqli_error($conn));
    }
}
function update($id){
    $contactId = $id;
    $name = "";
    $email = "";
    $phone = "";
    $fileName="";
    $tmpFile="";
    $saveFolder="";
    $error_status = 0;

    //name validate
    if(empty($_POST['name'])){
        setError('name',"Name input is required");
        $error_status = 1;
    }else{
        if(strlen($_POST['name']) < 5 ){
            setError('name',"Name is too short");
            $error_status = 1;
        }else{
            if(strlen($_POST['name']) > 20){
                setError('name',"Name is too long");
                $error_status = 1;
            }else{
                if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST['name'])) {
                    setError('name',"Only letters and white space allowed");
                    $error_status = 1;
                }else{
                    $name = textFilter($_POST['name']);
                }
            }
        }
    }
    //email validate
    if(empty($_POST['email'])){
        setError('email',"Email input is required");
        $error_status = 1;
    }else{
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            setError('email',"Email format incorrect");
            $error_status = 1;
        }else{
            $email = textFilter($_POST['email']);
        }
    }
    //phone validate
    if(empty($_POST['phone'])){
        setError('phone',"Phone input is required");
        $error_status = 1;
    }else{
        if(!preg_match("/^[0-9 ]*$/",$_POST['phone'])){
            setError('phone',"Phone format incorrect");
            $error_status = 1;
        }else{
            $phone = textFilter($_POST['phone']);
        }
    }

    //photo validate
    $supportFileType = ['image/png','image/jpeg'];
    if($_FILES['upload']['name']){
        $tmpFile = $_FILES['upload']['tmp_name'];
        $fileName = $_FILES['upload']['name'];
        if(in_array($_FILES['upload']['type'],$supportFileType)){
            $saveFolder = "css/images/";
        }else{
            setError('upload',"Incorrect file..");
            $error_status = 1;
        }
    }else{
        setError('upload',"Image file input is required");
        $error_status = 1;
    }




    if(!$error_status){
        move_uploaded_file($tmpFile,$saveFolder.$fileName);

        if(updateContact($name, $email, $phone, $fileName,$contactId)){
            $_SESSION['updateStatus'] = false;
            linkTo('index.php');
        }

    }
}
//update end

//general functions start
function linkTo($location){
      echo "<script>location.href='$location'</script>";
}

function old($inputName){
    if(isset($_POST[$inputName])){
        return $_POST[$inputName];
    }else{
        return "";
    }
}

function textFilter($text){
    $text = trim($text);
    $text = htmlentities($text,ENT_QUOTES);
    $text = stripcslashes($text);
    return $text;
}
////general functions end

//Error Handing start
function setError($inputName,$message){
    $_SESSION['error'][$inputName] = $message;
}
function getError($inputName){
    if(isset($_SESSION['error'][$inputName])){
        return $_SESSION['error'][$inputName];
    }
}

function clearError(){
    $_SESSION['error'] = [];
}
//Error Handling End

?>