<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Signup - QueryLab</title>
  <link href="<?= ROOT ?>/assets/css/style.css" rel="stylesheet">
  <link href="<?= ROOT ?>/assets/css/login.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="<?= ROOT ?>/assets/images/favicon.png" rel="icon">
</head>

<body class="text-center">

<div class="wrapper">
  <form action="" method="post">

    <h1>Sign Up</h1>

    <?php if(!empty($errors)):?>
      <div class="errors">
        <?= implode("<br>", $errors)?>
      </div>
    <?php endif;?>

    <div class="input-box">
      <input name="email" type="email" placeholder="Email" required>
      <i class='bx bx-at'></i>
    </div>

    <div class="input-box">
      <input name="username" type="text" placeholder="Username" required>
      <i class='bx bxs-user'></i>
    </div>

    <div class="input-box">
      <input name="password" type="password" placeholder="Password" required>
      <i class='bx bxs-lock-alt' ></i>
    </div>
    
    <button type="submit" class="btn">Signup</button>

    <div class="register-link">
      <p>Already have an account? <a href="<?=ROOT?>/login">Login</a></p>
    </div>
  </form>
</div>

</body>

</html>