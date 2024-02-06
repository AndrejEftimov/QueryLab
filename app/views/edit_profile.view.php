<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile - QueryLab</title>
    <link href="<?= ROOT ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/header.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/edit_profile.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="<?= ROOT ?>/assets/images/favicon.png" rel="icon">
</head>

<body class="text-center">

    <?php require($_SERVER["DOCUMENT_ROOT"] . '/QueryLab/app/views/header.view.php') ?>

    <div class="canvas">
        <img src="<?= ROOT ?>/assets/images/<?= $user->profile_image ?>" alt="" class="profile-image">

        <form action="<?= ROOT ?>/profile/edit/<?=$user->id?>" method="post">

            <?php if (!empty($errors)): ?>
                <div class="errors">
                    <?= implode("<br>", $errors) ?>
                </div>
            <?php endif; ?>

            <input name="username" type="text" class="username" value="<?=$user->username?>" required placeholder="Username...">
            <textarea name="description" class="description" id="" cols="30" rows="10"
                required placeholder="Description..."><?=$user->description?></textarea>

            <input type="submit" class="save-btn" value="Save">
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('.multiple-select').select2();
        });
    </script>

</body>

</html>