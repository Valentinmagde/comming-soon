<?php
  $host = "localhost";
  $username = "root";
  $password = "k!tEc0le";
  $dbName = "kitecole";
  
  try {
    // Create connection
    $conn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $email = $_POST['email'];

    // Create new subscriber
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        // $sql = "INSERT INTO subscribers (email)
        // VALUES ('$email')";

        // $conn->exec($sql);

        $stmt = $conn->prepare("INSERT INTO subscribers (email) VALUES (:email)");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        echo "OK";
    }
    else{
        echo "Please provide a valid e-mail address";
    }
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
?>
