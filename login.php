<?php
if(isset($_SESSION['user_id'])){
      header_register_callback('loction:login.php');
      exit;
}
if(isset($_POST['username'])&&isset($_POST['password'])){
      $username=$_POST['username'];
      $password=$_POST['password'];

      $db=new PDO('MYSQL:host=localhost;dbname=mydb','root');
      $sql="SELECT*FROM user WHERE username=? and password =?";
      $statement=$db->prepare($sql);
      $statement->execute([$usrename,$password]);
      $user=$statement->fetch(PDO::FETCH_ASSOC);

      IF($user){
            $_SESSION['user_id']=$user['id'];
            hearder('location:login.php');
            exit;
      }
}
?>