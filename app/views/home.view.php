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
          <option <?php echo (in_array($tag->name, $selected_tags) ? "selected" : ""); ?> value="<?= $tag->name ?>">
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
            <a class="username" href="<?= ROOT ?>/profile/index/<?= $row[0]->user_id ?>">
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
            <p id="<?= $row['0']->id ?>" class="upvote <?= ($row['2'] == true) ? 'upvoted' : '' ?>"
              onclick="update_upvote(<?= $row['0']->id ?>, <?= $_SESSION['USER']->id ?>,)">
              <i class='bx bx-upvote'></i> Upvote &middot;
              <span class="upvote-count">
                <?= $row[0]->upvote_count ?>
              </span>
            </p>
            <a class="reply" href="<?= ROOT ?>/answers/index/<?= $row[0]->id ?>">
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