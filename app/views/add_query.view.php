<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Query - QueryLab</title>
    <link href="<?= ROOT ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/header.css" rel="stylesheet">
    <link href="<?= ROOT ?>/assets/css/add_query.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="<?= ROOT ?>/assets/images/favicon.png" rel="icon">
    <link href="<?= ROOT ?>/assets/css/select2.min.css" rel="stylesheet" />
    <script src="<?= ROOT ?>/assets/js/jquery-3.7.1.js"></script>
    <script src="<?= ROOT ?>/assets/js/select2.min.js"></script>
</head>

<body class="text-center">

    <?php require($_SERVER["DOCUMENT_ROOT"] . '/QueryLab/app/views/header.view.php') ?>

    <div class="canvas">

        <form action="<?= ROOT ?>/queries/add" method="post" enctype="multipart/form-data">
            <input name="title" type="text" class="title" placeholder="Title..." required>
            <textarea name="text" class="text" id="" cols="30" rows="10" placeholder="Talk about anything..."
                required></textarea>

            <select class="multiple-select" name="tags[]" multiple="multiple" required>
                <?php foreach ($tags as $tag): ?>
                    <option value="<?= $tag->name ?>"><?= $tag->name ?></option>
                <?php endforeach; ?>
            </select>

            <label for="file-upload" class="custom-file-upload">
                <i class='bx bx-image-alt'></i>
                Add Image
            </label>
            <input type="file" name="fileToUpload" id="file-upload">

            <input type="submit" class="submit-btn" value="Create">
        </form>


    </div>

    <script>
        $(document).ready(function () {
            $('.multiple-select').select2();
        });
    </script>

</body>

</html>