<?php
session_start();
require_once 'function/functions.php';
$photo = query('SELECT * FROM photo ');
// var_dump($photo);


$profile = query("SELECT * FROM profil");
// var_dump($profile);

if (isset($_GET["cari"])) {
    $photo = cariCaption($_GET["cari"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Profile • Instagram</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/v4-shims.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <nav class="navigation">
        <div class="navigation__column">
            <a href="feed.php">
                <img src="images/logo.png" />
            </a>
        </div>
        <div class="navigation__column">
            <i class="fa fa-search"></i>
            <form action="" method="get" enctype="multipart/form-data" autocomplete="off">
                <input type="text" name="cari" placeholder="Search">
            </form>
        </div>
        <div class="navigation__column">
            <ul class="navigations__links">
                <li class="navigation__list-item">
                    <a href="posts.php" class="navigation__link">
                        <i class="far fa-plus-square fa-lg"></i>
                    </a>
                </li>
				<li class="navigation__list-item">
                    <a href="explore.php" class="navigation__link">
                        <i class="fa fa-compass fa-lg"></i>
                    </a>
                </li>
                <li class="navigation__list-item">
                    <a href="#" class="navigation__link">
                        <i class="fa fa-heart-o fa-lg"></i>
                    </a>

                </li>
                <li class="navigation__list-item">
                    <a href="profile.php" class="navigation__link">
                        <i class="fa fa-user-o fa-lg"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <main id="profile">
        <header class="profile__header">
            <div class="profile__column">
                <img src="images/avatar.jpg" />
            </div>
            <div class="profile__column">
                <div class="profile__title">
                    <h3 class="profile__username"><?= $profile[0]['username']; ?></h3>
                    <a href="edit-profile.php?id=<?= $profile[0]['id']; ?>">Edit profile</a>
                    <a href="logout.php" id="logout" ><i class="fa fa-cog fa-lg" ></i></a>
                </div>
                <ul class="profile__stats">
                    <li class="profile__stat">
                        <span class="stat__number"><?= count($photo); ?></span> posts
                    </li>
                    <li class="profile__stat">
                        <span class="stat__number">436</span> followers
                    </li>
                    <li class="profile__stat">
                        <span class="stat__number">287</span> following
                    </li>
                </ul>
                <p class="profile__bio">
                    <span class="profile__full-name">
                        <?= $profile[0]['nama']; ?>
                    </span>
					<br>
                    <?= $profile[0]['bio']; ?>
                    <a href="<?= $profile[0]['website']; ?>"><?= $profile[0]['website']; ?></a>
                </p>
            </div>
        </header>
        <section class="profile__photos">
            <?php foreach ($photo as $row) : ?>
                <div class="profile__photo">
                    <img src="img/<?= $row['gambar']; ?>" class="center-cropped" />
                    <div class="profile__photo-overlay">
                        <span class="overlay__item">
                            <i class="fa fa-heart"></i>
                            100
                        </span>
                        <span class="overlay__item">
                            <i class="fa fa-comment"></i>
                            20
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
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