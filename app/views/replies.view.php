<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Post replies - QueryLab</title>
    <link href="<?= ROOT ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/header.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/replies.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="<?= ROOT ?>/assets/images/favicon.png" rel="icon">
</head>

<body class="text-center">

    <?php require($_SERVER["DOCUMENT_ROOT"] . '/QueryLab/app/views/header.view.php') ?>

    <div class="canvas">

        <div class="post">

            <div class="user-info">
                <img src="<?= ROOT ?>/assets/images/<?= $post->profile_image ?>" alt="">
                <a class="username" href="<?= ROOT ?>/profile/index/<?= $post->user_id ?>">
                    <?= $post->username ?>
                </a>
            </div>

            <div class="post-info">
                <p class="date"> &middot;
                    <?= $post->date ?>
                </p>
                <div class="tags">
                    <?php foreach ($tags as $tag): ?>
                        <p>
                            <?= $tag->name ?>
                        </p>
                    <?php endforeach; ?>
                </div>
                <p class="title">
                    <?= $post->title ?>
                </p>
                <p class="text">
                    <?= $post->text ?>
                </p>
                <img src="<?= ROOT ?>/assets/images/<?= $post->image ?>" alt="">
            </div>

            <div class="actions">
                <a class="upvote" href="#">
                    <i class='bx bx-upvote'></i>
                    Upvote &middot;
                    <?= $post->upvote_count ?>
                </a>
                <a class="reply" href="#">
                    <i class='bx bx-comment'></i>
                    Reply &middot;
                    <?= $post->reply_count ?>
                </a>
            </div>

        </div>

        <form action="<?= ROOT ?>/answers/index" method="post">
            <input type="hidden" name="user_id" value="<?= $_SESSION['USER']->id ?>">
            <input type="hidden" name="post_id" value="<?= $post->id ?>">
            <input type="submit" class="submit-btn" value="Reply">
            <textarea name="text" class="text" id="" cols="30" rows="10" placeholder="Write your answer..."
                required></textarea>
        </form>

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