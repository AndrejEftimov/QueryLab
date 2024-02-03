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
    <form>

      <input class="submit-btn" type="submit" value="Search">

      <select class="multiple-select" name="tags[]" multiple="multiple">
        <option value="option1">option1option1option1</option>
        <option value="option1">option1</option>
        <option value="option1">option1</option>
      </select>

    </form>

    <div class="posts">
      <div class="post">

        <div class="user-info">
          <img src="<?= ROOT ?>/assets/images/LoginSignup.jpg" alt="">
          <a class="username" href="">Username</a>
        </div>

        <div class="post-info">
          <p class="date"> &middot; 31.01.2024 &nbsp;00:00</p>
          <div class="tags">
            <p>tag1</p>
            <p>tag2</p>
          </div>
          <p class="title">This is the title!</p>
          <p class="text">
            texttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttext
          </p>
          <img src="<?= ROOT ?>/assets/images/LoginSignup.jpg" alt="">
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
    </div>
  </div>

  <script>
    $(document).ready(function () {
      $('.multiple-select').select2();
    });
  </script>

</body>

</html>