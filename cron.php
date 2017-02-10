<?php

require_once __DIR__ . '/config.php';

$vk = new VK('', 139842925, '5.62');
$photo = $vk->uploadImageOnServer('photo.jpg');
$res = $vk->photosSaveWallPhoto($photo->server, $photo->photo, $photo->hash);
$vk->wallPost('Test Photo', 'photo' . $res->response[0]->owner_id . '_' . $res->response[0]->id);
