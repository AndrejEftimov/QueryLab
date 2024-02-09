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
            <?php foreach ($rows as $key => $row): ?>
                <?php
                $reply = $row[0];
                $upvoted = $row[1];
                ?>
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
                        <p id="<?= $reply->id ?>" class="upvote <?= ($upvoted == true) ? 'upvoted' : '' ?>"
                            onclick="update_upvote(<?= $reply->id ?>, <?= $_SESSION['USER']->id ?>,)">
                            <i class='bx bx-upvote'></i>
                            Upvote &middot;
                            <span class="upvote-count">
                                <?= $reply->upvote_count ?>
                            </span>
                        </p>
                        <a class="view-post" href="<?= ROOT ?>/answers/index/<?= $reply->post_id ?>">
                            VIEW POST
                        </a>
                    </div>
                </div>

                <?php if ($key != array_key_last($rows)): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

    </div>

    <script>
        function update_upvote(reply_id, user_id) {
            var element = document.getElementById(reply_id);
            var upvote_count = element.getElementsByClassName("upvote-count")[0];

            const xhr = new XMLHttpRequest();
            var url = '';

            if (element.classList.contains('upvoted')) {
                element.classList.remove('upvoted');
                url = "<?= ROOT . "/upvotes/decrement" ?>";
            }
            else {
                element.classList.add('upvoted');
                url = "<?= ROOT . "/upvotes/increment" ?>";
            }

            // Configure the request
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            // Set up a callback function to handle the response
            xhr.onload = function () {
                if (xhr.status === 200) {
                    upvote_count.innerHTML = xhr.responseText;
                } else {
                    console.error('Request failed:', xhr.status, xhr.statusText);
                }
            };

            // Send the request
            xhr.send("reply_id=" + reply_id + "&" + "user_id=" + user_id);
        }
    </script>

</body>

</html>