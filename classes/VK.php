<?php

class VK extends Web
{
    /**
     * Token from VK
     *
     * @var string $_token
     */
    private $_token = '';

    /**
     * ID group from VK
     *
     * @var int $_groupID
     */
    private $_groupID = null;

    /**
     * Version API VK
     *
     * @var int $_version
     */
    private $_version = null;

    const VK_METHOD = 'https://api.vk.com/method/';

    /**
     * Constructor.
     *
     * @param string $token
     * @param int $groupID
     * @param string $version
     */
    public function __construct($token, $groupID, $version)
    {
        $this->_token = $token;
        $this->_groupID = $groupID;
        $this->_version = $version;
    }

    /**
     * Upload image on VK server
     *
     * @return object
     */
    public function uploadImage()
    {
        $cFile = curl_file_create( realpath( 'img/schedule.png' ) );
        $fields = [ 'photo' => $cFile ];

        return $this->curl(
            $this->getUploadServer()->response->upload_url,
            'POST',
            $fields
        );
    }

    /*
     * Get upload link from vk api
     */
    public function getUploadServer()
    {
        return $this->curl(self::VK_METHOD . 'photos.getWallUploadServer?group_id='.$this->_groupID.'&v=5.62&access_token=' . $this->_token);
    }

    /*
     * Save image on VK server
     */
    public function photoSave()
    {
        $photoInfo = $this->uploadImage();
        return $this->curl(self::VK_METHOD . 'photos.saveWallPhoto?group_id=' . $this->_groupID . '&server=' . $photoInfo->server . '&photo=' . stripslashes($photoInfo->photo) . '&hash=' . $photoInfo->hash . '&v=' . $this->_version . '&access_token=' . $this->_token);
    }

    /*
     * Post image on group wall
     */
    public function postOnWall()
    {
        $photoInfo = $this->photoSave();
        return $this->curl(self::VK_METHOD . 'wall.post?owner_id=-' . $this->_groupID . '&message=vk_api&attachments=photo' . $photoInfo->response[0]->owner_id . '_' . $photoInfo->response[0]->id . '&v=' . $this->_version . '&access_token=' . $this->_token);
    }
}