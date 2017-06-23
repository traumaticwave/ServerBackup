<?php  
session_start();  
$connect = mysqli_connect("localhost", "root", "8tty8lbm88_H", "friends");  
if(isset($_POST["username"])) {  
     $query = "SELECT * FROM members
     WHERE name = '".$_POST["username"]."'  
     AND password = '".sha1($_POST["password"])."'";  

     $result = mysqli_query($connect, $query);  
     if(mysqli_num_rows($result) > 0) {  
          $_SESSION['username'] = $_POST['username'];  
          echo 'Yes';  
     } else {  
          echo 'No';  
     }  
} 
mysqli_close($connect);

if(isset($_POST["action"]))  
{  
     unset($_SESSION["username"]);  
}  
?>
