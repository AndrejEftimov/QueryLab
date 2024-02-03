<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login - QueryLab</title>
  <link href="<?= ROOT ?>/assets/css/style.css" rel="stylesheet">
  <link href="<?= ROOT ?>/assets/css/login.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="text-center">

<div class="wrapper">
  <form action="" method="post">

    <h1>Login</h1>

    <?php if(!empty($errors)):?>
      <div class="errors">
        <?= implode("<br>", $errors)?>
      </div>
    <?php endif;?>

    <div class="input-box">
      <input name="username" type="text" placeholder="Username" required>
      <i class='bx bxs-user'></i>
    </div>

    <div class="input-box">
      <input name="password" type="password" placeholder="Password" required>
      <i class='bx bxs-lock-alt' ></i>
    </div>
    
    <button type="submit" class="btn">Login</button>

    <div class="register-link">
      <p>Don't have an account? <a href="<?=ROOT?>/signup">Register</a></p>
    </div>
  </form>
</div>

</body>

</html>