<?php

require_once 'db.php';

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $pass = mysqli_real_escape_string($conn, $data['password']);
	$name = strtolower(stripslashes($data["username"]));
    $email = htmlspecialchars($data["email"]);

    $result = mysqli_query($conn, "SELECT username WHERE username = '$username' ");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>username already exist! </script>";
        return false;
    }

    // enkripsi password
    $pass = password_hash($pass, PASSWORD_DEFAULT);

    if (!empty(trim($username)) && !empty(trim($pass))) {
        mysqli_query($conn, "INSERT INTO user VALUES('','$username','$pass','$name','$email')");
    }

    return mysqli_affected_rows($conn);
}
