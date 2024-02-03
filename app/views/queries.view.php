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

      <?php foreach ($posts as $post): ?>
        <?php $tags = explode(", ", $post->tags) ?>

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
                <p><?=$tag?></p>
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
              Upvote
            </a>
            <a class="reply" href="#">
              <i class='bx bx-comment'></i>
              Reply
            </a>
          </div>

        </div>

      <?php endforeach; ?>

    </div>

  </div>

</body>

</html>