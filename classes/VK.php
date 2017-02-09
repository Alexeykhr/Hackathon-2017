<?php

class VK extends Web
{
    /**
     * Token from VK.
     *
     * @var string $_token
     */
    private $_token = '';

    /**
     * ID group from VK.
     *
     * @var int $_groupID
     */
    private $_groupID = null;

    /**
     * Version API VK.
     *
     * @var int $_version
     */
    private $_version = null;

    const VK_URL = 'https://api.vk.com/method/';

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
     * Upload image on VK server.
     *
     * @return object
     */
    public function uploadImageOnServer()
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
     * Get upload link from vk api.
     */
    public function getUploadServer()
    {
        return $this->curl(self::VK_URL . 'photos.getWallUploadServer?group_id='.$this->_groupID.'&v=5.62&access_token=' . $this->_token);
    }

    /*
     * Save image on VK server.
     */
    public function photoSaveOnServer()
    {
        $photoInfo = $this->uploadImageOnServer();
        return $this->curl(self::VK_URL . 'photos.saveWallPhoto?group_id=' . $this->_groupID . '&server=' . $photoInfo->server . '&photo=' . stripslashes($photoInfo->photo) . '&hash=' . $photoInfo->hash . '&v=' . $this->_version . '&access_token=' . $this->_token);
    }

    /**
     * Post on group VK.
     *
     * @param string $message
     * @param string $attachments
     * @return object
     */
    public function postOnWall($message, $attachments = '')
    {
        return $this->sendVK('wall.post', [
            'owner_id'    => '-' . $this->_groupID,
            'message'     => $message,
            'attachments' => $attachments,
        ]);
     }

    /**
     * Post request.
     *
     * @param string $method
     * @param array $params
     * @param string $http
     * @param array $fields
     */
    public function sendVK($method, $params, $http = 'GET', $fields = [])
    {
        $url = self::VK_URL . $method . '?' . http_build_query($params)
            . '&v=' . $this->_version . '&access_token=' . $this->_token;

        $this->curl($url, $http, $fields);
    }
}