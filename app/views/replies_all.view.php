<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Replies - QueryLab</title>
    <link href="<?= ROOT ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/header.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/replies_all.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="<?= ROOT ?>/assets/images/favicon.png" rel="icon">
</head>

<body class="text-center">

    <?php require($_SERVER["DOCUMENT_ROOT"] . '/QueryLab/app/views/header.view.php') ?>

    <div class="canvas">

        <div class="replies">
            <?php foreach ($replies as $key => $reply): ?>
                <div class="reply">

                    <div class="user-info">
                        <img src="<?= ROOT ?>/assets/images/<?= $reply->profile_image ?>" alt="">
                        <a class="username" href="<?= ROOT ?>/profile/index/<?= $reply->user_id ?>">
                            <?= $reply->username ?>
                        </a>
                    </div>

                    <div class="reply-info">
                        <p class="date"> &middot;
                            <?= $reply->date ?>
                        </p>
                        <p class="text">
                            <?= $reply->text ?>
                        </p>
                    </div>

                    <div class="actions">
                        <a class="upvote" href="#">
                            <i class='bx bx-upvote'></i>
                            Upvote &middot;
                            <?= $reply->upvote_count ?>
                        </a>
                        <a class="view-post" href="<?=ROOT?>/answers/index/<?=$reply->post_id?>">
                        VIEW POST
                        </a>
                    </div>
                </div>

                <?php if ($key != array_key_last($replies)): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

    </div>

</body>

</html>