<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>My Queries - QueryLab</title>
  <link href="<?= ROOT ?>/assets/css/style.css" rel="stylesheet">
  <link href="<?= ROOT ?>/assets/css/header.css" rel="stylesheet">
  <link href="<?= ROOT ?>/assets/css/queries.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="<?= ROOT ?>/assets/images/favicon.png" rel="icon">
</head>

<body class="text-center">

  <?php require($_SERVER["DOCUMENT_ROOT"] . '/QueryLab/app/views/header.view.php') ?>

  <div class="canvas">

    <a class="add-query" href="<?= ROOT ?>/Queries/add">Add Query</a>

    <div class="posts">

      <?php foreach ($rows as $row): ?>
        <?php
        $post = $row[0];
        $tags = $row[1];
        $upvoted = $row[2];
        ?>

        <div class="post">

          <div class="user-info">
            <img src="<?= ROOT . "/assets/images/" . $_SESSION['USER']->profile_image ?>" alt="">
            <a class="username" href="">
              <?= $_SESSION['USER']->username ?>
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
            <p id="<?= $post->id ?>" class="upvote <?= ($upvoted == true) ? 'upvoted' : '' ?>"
              onclick="update_upvote(<?= $post->id ?>, <?= $_SESSION['USER']->id ?>,)">
              <i class='bx bx-upvote'></i>
              Upvote &middot;
              <span class="upvote-count">
                <?= $post->upvote_count ?>
              </span>
            </p>
            <a class="reply" href="<?= ROOT ?>/answers/index/<?= $post->id ?>">
              <i class='bx bx-comment'></i>
              Reply &middot;
              <?= $post->reply_count ?>
            </a>
          </div>

        </div>

      <?php endforeach; ?>

    </div>

  </div>

  <script>
    function update_upvote(post_id, user_id) {
      var element = document.getElementById(post_id);
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
  </script>

</body>

</html>