<?php

require_once __DIR__ . '/classes/Web.php';
require_once __DIR__ . '/classes/VK.php';
require_once __DIR__ . '/classes/OVVA.php';

$vk = new VK('', 139842925, '5.62');
$photo = $vk->uploadImageOnServer('photo.jpg');
$res = $vk->photosSaveWallPhoto($photo->server, $photo->photo, $photo->hash);
$vk->wallPost('Test Photo', 'photo' . $res->response[0]->owner_id . '_' . $res->response[0]->id);

die;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="container">
    <h1>Телепрограмма на <?= $data->data->date; ?></h1>

    <div class="items">
        <?php foreach ($data->data->programs as $program) : ?>
        <div class="item">
            <img src="<?= $program->image->preview; ?>" alt="<?= $program->title; ?>">
            <?= $program->title . ' ' . $program->subtitle; ?>
            Початок: <?= date("H:i", $program->realtime_begin); ?>
        </div>
        <?php endforeach; ?>
    </div>

</div>

</body>
</html>
