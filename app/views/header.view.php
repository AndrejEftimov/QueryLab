<header class="header">
    <a href="#" class="logo">QueryLab</a>

    <nav class="navbar">
        <?php if ($_SESSION['USER']->type == 'admin'): ?>
            <a class="<?php active('admin'); ?>" href="<?= ROOT ?>/admin/index">Administrator</a>
        <?php endif; ?>
        <a class="<?php active('home'); ?>" href="<?= ROOT ?>/home/index">Home</a>
        <a class="<?php active('profile'); ?>" href="#">Profile</a>
        <a class="<?php active('queries'); ?>" href="<?= ROOT ?>/Queries/index">Queries</a>
        <a class="<?php active('answers'); ?>" href="#">Answers</a>
        <a href="<?= ROOT ?>/logout/index">Logout</a>
    </nav>
</header>