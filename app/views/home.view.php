<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Home - QueryLab</title>
  <link href="<?= ROOT ?>/assets/css/style.css" rel="stylesheet">
  <link href="<?= ROOT ?>/assets/css/header.css" rel="stylesheet">
  <link href="<?= ROOT ?>/assets/css/home.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="<?= ROOT ?>/assets/images/favicon.png" rel="icon">
  <link href="<?= ROOT ?>/assets/css/select2.min.css" rel="stylesheet" />
  <script src="<?= ROOT ?>/assets/js/jquery-3.7.1.js"></script>
  <script src="<?= ROOT ?>/assets/js/select2.min.js"></script>
</head>

<body class="text-center">

  <?php require($_SERVER["DOCUMENT_ROOT"] . '/QueryLab/app/views/header.view.php') ?>

  <div class="canvas">
    <form action="<?= ROOT ?>/home/index" method="post">

      <input class="submit-btn" type="submit" value="Search">
      <select class="multiple-select" name="tags[]" multiple="multiple" required>
        <?php foreach ($tags as $tag): ?>
          <option <?php echo(in_array($tag->name, $selected_tags) ? "selected" : ""); ?> value="<?= $tag->name ?>">
            <?= $tag->name ?>
          </option>
        <?php endforeach; ?>
      </select>

    </form>

    <div class="posts">

      <?php foreach ($rows as $row): ?>

        <div class="post">

          <div class="user-info">
            <img src="<?= ROOT ?>/assets/images/<?= $row[0]->profile_image ?>" alt="">
            <a class="username" href="<?=ROOT?>/profile/index/<?=$row[0]->user_id?>">
              <?= $row[0]->username ?>
            </a>
          </div>

          <div class="post-info">
            <p class="date"> &middot;
              <?= $row[0]->date ?>
            </p>
            <div class="tags">
              <?php foreach ($row[1] as $tag): ?>
                <p>
                  <?= $tag->name ?>
                </p>
              <?php endforeach; ?>
            </div>
            <p class="title">
              <?= $row[0]->title ?>
            </p>
            <p class="text">
              <?= $row[0]->text ?>
            </p>
            <img src="<?= ROOT ?>/assets/images/<?= $row[0]->image ?>" alt="">
          </div>

          <div class="actions">
            <a class="upvote" href="#">
              <i class='bx bx-upvote'></i>
              Upvote &middot;
              <?= $row[0]->upvote_count ?>
            </a>
            <a class="reply" href="<?=ROOT?>/answers/index/<?=$row[0]->id?>">
              <i class='bx bx-comment'></i>
              Reply &middot;
              <?= $row[0]->reply_count ?>
            </a>
          </div>

        </div>

      <?php endforeach; ?>

    </div>
  </div>

  <script>
    $(document).ready(function () {
      $('.multiple-select').select2();
    });
  </script>

</body>

</html>