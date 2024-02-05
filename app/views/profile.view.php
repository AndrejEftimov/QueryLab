<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile - QueryLab</title>
    <link href="<?= ROOT ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/header.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/profile.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="<?= ROOT ?>/assets/images/favicon.png" rel="icon">
</head>

<body class="text-center">

    <?php require($_SERVER["DOCUMENT_ROOT"] . '/QueryLab/app/views/header.view.php') ?>

    <div class="canvas">
        <img src="<?= ROOT ?>/assets/images/<?= $user->profile_image ?>" alt="" class="profile-image">
        <?php if ($user->id == $_SESSION['USER']->id): ?>
            <a class="edit" href="<?= ROOT ?>/profile/edit/<?=$user->id?>">Edit</a>
        <?php endif; ?>

        <p class="username">Username: <?= $user->username ?></p>
        <p class="email">Email: <?= $user->email ?></p>
        <p class="date-joined">Joined: <?= $user->date_joined ?></p>
        <p class="credits">Credits: <?= $user->credits ?></p>
        <p class="desc"><?= $user->description ?></p>
    </div>

    <script>
        $(document).ready(function () {
            $('.multiple-select').select2();
        });
    </script>

</body>

</html>