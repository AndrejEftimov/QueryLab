<header class="header">
    <a href="<?= ROOT ?>/home/index" class="logo">QueryLab</a>

    <nav class="navbar">
        <?php if ($_SESSION['USER']->type == 'admin'): ?>
            <a class="<?php active('admin'); ?>" href="<?= ROOT ?>/admin/index">Administrator</a>
        <?php endif; ?>
        <a class="<?php active('home'); ?>" href="<?= ROOT ?>/home/index">Home</a>
        <a class="<?php if(!empty($user)){ if($user->id == $_SESSION['USER']->id){ active('profile'); }} ?>" href="<?= ROOT ?>/profile/index/<?=$_SESSION['USER']->id?>">Profile</a>
        <a class="<?php active('queries'); ?>" href="<?= ROOT ?>/queries/index">Queries</a>
        <a class="<?php active('answers'); ?>" href="#">Answers</a>
        <a href="<?= ROOT ?>/logout/index">Logout</a>
    </nav>
</header>