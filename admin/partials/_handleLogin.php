<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'connection.php';
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    
    $sql = "Select * from tbl_users where username='$username'"; 
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        $row=mysqli_fetch_assoc($result);
        $userType = $row['userType'];
        if($userType == 1) {
            $userId = $row['id'];
            if (password_verify($password, $row['password'])){ 
                session_start();
                $_SESSION['adminloggedin'] = true;
                $_SESSION['adminusername'] = $username;
                $_SESSION['adminuserId'] = $userId;
                header("location: /food-ordering-system/admin/index.php?loginsuccess=true");
                exit();
            } 
            else{
                header("location: /food-ordering-system/admin/login.php?loginsuccess=false");
            }
        }
        else {
            header("location: /food-ordering-system/admin/login.php?loginsuccess=false");
        }
    } 
    else{
        header("location: /food-ordering-system/admin/login.php?loginsuccess=false");
    }
}    
?>