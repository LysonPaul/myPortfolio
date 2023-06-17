<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  // Validate the name
  if (empty($_POST["name"])) {
    echo "Please enter your name.";
  } else {
    $name = $_POST["name"];
  }

  // Validate the email
  if (empty($_POST["email"])) {
    echo "Please enter your email.";
  } else {
    $email = $_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "Invalid email address.";
    } else {
      // Check if the email address is already in use
      $sql = "SELECT * FROM users WHERE email = '$email'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        echo "This email address is already in use.";
      }
    }
  }

  // Validate the password
  if (empty($_POST["password"])) {
    echo "Please enter a password.";
  } else {
    $password = $_POST["password"];
    if (strlen($password) < 8) {
      echo "Your password must be at least 8 characters long.";
    }
  }

  // Validate the confirm password
  if (empty($_POST["confirm_password"])) {
    echo "Please confirm your password.";
  } else {
    $confirm_password = $_POST["confirm_password"];
    if ($password != $confirm_password) {
      echo "Your passwords do not match.";
    }
  }

  // If all of the validation checks have passed, proceed to create the user account
  if (!empty($name) && !empty($email) && !empty($password) && $password == $confirm_password) {
    // Hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user data into the database
    $sql = "INSERT INTO user(name, email, password) VALUES ('$name', '$email', '$password')";
    mysqli_query($conn, $sql);

    // Redirect the user to the homepage
    header("Location: connection.php");
  }

  if (empty($_POST["username"])) 
  {
    echo "Please enter your username.";
  } else 
  {
    $username = $_POST["username"];
  }
  if (empty($_POST["password"])) 
  {
    echo "Please enter your password.";
  } else 
  {
    $password = $_POST["password"];
  }
  
  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($sql);
  if (mysqli_num_rows($result) == 0) 
  {
    echo "This username does not exist.";
  } else 
  {
    $row = mysqli_fetch_assoc($result);
    $db_password = $row["password"];
    if (password_verify($password, $db_password)) 
    {
      
      $_SESSION["username"] = $username;
      header("Location: connection.php");
    } else 
    {
      echo "Incorrect password.";
    }
  }
}

?>