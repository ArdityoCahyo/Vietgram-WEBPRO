<?php
session_start();
require_once 'function/functions.php';
require_once 'function/user.php';

// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // enkripsi cookie
    if ($key === hash('shas256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_COOKIE['login'])) {
    if ($_COOKIE['login'] == 'true') {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION['login'])) {
    echo "<script>
  document.location.href = 'feed.php';
  </script>";
    exit;
}

if (isset($_POST["login"])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];


    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' ");


    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row["password"])) {
            // set session
            $_SESSION["login"] = true;
            // cek remember 
            if (isset($_POST['remember'])) {
                // buat cookie
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }
            header("Location: feed.php");
            exit;
        }
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Login • Instagram</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Vietgram, like Instagram but with Pho" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <main id="login">
        <div class="login__column">
            <img src="images/phoneImage.png" class="login__phone" />
        </div>
        <div class="login__column">
            <div class="login__box">
                <img src="images/loginLogo.png" class="login__logo" />
                <div>
                    <br>
                </div>
                <form action="" method="post" class="login__form">
                    <input type="text" name="username" placeholder="Username" required />
                    <input type="password" name="password" placeholder="Password" required />
                    <input type="submit" name="login" value="Log in" />
                </form>
                <span class="login__divider">or</span>
                <div>
                    <br>
                </div>
                <a href="#" class="login__link">
                    <i class="fa fa-facebook-square fa-lg"></i>
                    Log in with Facebook
                </a>
                <a href="#" class="login__link login__link--small">Forgot password</a>
            </div>
            <div class="login__box">
                <span>Don't have an account?</span> <a href="register.php">Sign up</a>
            </div>
            <div class="login__box--transparent">
                <span>Get the app.</span>
                <div class="login__appstores">
                    <img src="images/ios.png" class="login__appstore" alt="Apple appstore logo" title="Apple appstore logo" />
                    <img src="images/android.png" class="login__appstore" alt="Android appstore logo" title="Android appstore logo" />
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer__column">
            <nav class="footer__nav">
                <ul class="footer__list">
                    <li class="footer__list-item"><a href="#" class="footer__link">About Us</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Support</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Blog</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Press</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Api</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Jobs</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Privacy</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Terms</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Directory</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Language</a></li>
                </ul>
            </nav>
        </div>
        <div class="footer__column">
            <span class="footer__copyright">© 2020 Vietgram With Ardityo</span>
        </div>
    </footer>
</body>

</html>