<?php
function clearInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $backto = "Location: ./login.php?confirm=1";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $connection = new mysqli($servername, $username, $password, "miklo_benjamin_eplanner");
    $uname = clearInput($_POST['uname']);
    $fname = clearInput($_POST['fname']);
    $lname = clearInput($_POST['lname']);
    $email = clearInput($_POST['email']);
    $pwd = clearInput($_POST['pwd']);


    $date = date("Y-m-d");
    $sql = "INSERT INTO users(firstname, lastname, username, email, password, crdate) VALUES (?,?,?,?,?,?)";
    $stmt = $connection->prepare($sql);
    if($stmt){
        $stmt->bind_param("ssssss",$fname,$lname,$uname,$email,$pwd,$date);
        $stmt->execute();
        $backto = "Location: ./login.php?confirm=0";
    }
    else{
        die("ERROR: " . $connection->error);
    }
}
header($backto);
exit;
$connection->close();
?>