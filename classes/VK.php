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
        /* Temporary */
        $fields = [];
//        $cFile = curl_file_create( realpath( 'img/schedule.png' ) );
//        $fields = [ 'photo' => $cFile ];

        return $this->curl(
            $this->photosGetWallUploadServer()->response->upload_url,
            'POST',
            $fields
        );
    }

    /*
     * Get upload link from vk api.
     */
    public function photosGetWallUploadServer()
    {
        return $this->request('photos.getWallUploadServer', [
            'group_id' => $this->_groupID,
        ]);
    }

    /**
     * Save photos wall on VK server.
     *
     * @param string $server
     * @param $photo
     * @param $hash
     * @return object
     */
    public function photosSaveWallPhoto($server, $photo, $hash)
    {
        return $this->request('photos.saveWallPhoto', [
            'group_id' => $this->_groupID,
            'server'   => $server,
            'photo'    => $photo,
            'hash'     => $hash
        ]);
    }

    /**
     * Post on group VK.
     *
     * @param string $message
     * @param string $attachments
     * @return object
     */
    public function wallPost($message, $attachments = '')
    {
        return $this->request('wall.post', [
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
    public function request($method, $params, $http = 'GET', $fields = [])
    {
        $url = self::VK_URL . $method . '?' . http_build_query($params)
            . '&v=' . $this->_version . '&access_token=' . $this->_token;

        $this->curl($url, $http, $fields);
    }
}