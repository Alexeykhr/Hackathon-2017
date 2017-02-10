<?php

require_once __DIR__ . '/config.php';

$screen = new ScreenShots();
$screen->saveImageFromWeb( $screen->makeScreenshots('') );

$vk = new VK('', 139842925, '5.62');
$photo = $vk->uploadImageOnServer('screen.png');
$res = $vk->photosSaveWallPhoto($photo->server, $photo->photo, $photo->hash);
$vk->wallPost('', 'photo' . $res->response[0]->owner_id . '_' . $res->response[0]->id);
