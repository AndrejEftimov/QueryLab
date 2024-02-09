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

            <?php
            $post = $post_data[0];
            $tags = $post_data[1];
            $upvoted = $post_data[2];
            ?>

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
                <p id="<?= "post_" . $post->id ?>" class="upvote <?= ($upvoted == true) ? 'upvoted' : '' ?>"
                    onclick="update_post_upvote(<?= $post->id ?>, <?= $_SESSION['USER']->id ?>,)">
                    <i class='bx bx-upvote'></i>
                    Upvote &middot;
                    <span class="upvote-count">
                        <?= $post->upvote_count ?>
                    </span>
                </p>
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
            <?php foreach ($replies_data as $key => $reply_data): ?>
                <?php
                $reply = $reply_data[0];
                $upvoted = $reply_data[1];
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
                        <p id="<?= "reply_" . $reply->id ?>" class="upvote <?= ($upvoted == true) ? 'upvoted' : '' ?>"
                            onclick="update_reply_upvote(<?= $reply->id ?>, <?= $_SESSION['USER']->id ?>,)">
                            <i class='bx bx-upvote'></i>
                            Upvote &middot;
                            <span class="upvote-count">
                                <?= $reply->upvote_count ?>
                            </span>
                        </p>
                    </div>
                </div>

                <?php if ($key != array_key_last($replies_data)): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

    </div>

    <script>
        function update_post_upvote(post_id, user_id) {
            var element = document.getElementById('post_' + post_id);
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
            xhr.send("post_id=" + post_id + "&" + "user_id=" + user_id);
        }


        function update_reply_upvote(reply_id, user_id) {
            var element = document.getElementById('reply_' + reply_id);
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