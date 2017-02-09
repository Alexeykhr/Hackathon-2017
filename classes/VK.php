<?php

class VK extends Web
{
    /** @var int $groupID id group from VK. */
    public $groupID = null;

    /** @var string $_token user token from VK. */
    private $_token = '';

    /** @var int $_version version api VK. */
    private $_version = null;

    /** @var string VK_URL url VK api. */
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
        $this->groupID = $groupID;
        $this->_version = $version;
    }

    /**
     * Upload image on VK server.
     *
     * @param string $photo
     * @return object
     */
    public function uploadImageOnServer($photo)
    {
        return $this->curl(
            $this->photosGetWallUploadServer()->response->upload_url,
            'POST',
            ['photo' => curl_file_create( realpath(__DIR__ . '/../img/' . $photo ) )]
        );
    }

    /**
     * Get upload link from VK api.
     *
     * @return object
     */
    public function photosGetWallUploadServer()
    {
        return $this->request('photos.getWallUploadServer', [
            'group_id' => $this->groupID,
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
            'group_id' => $this->groupID,
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
            'owner_id'    => '-' . $this->groupID,
            'message'     => $message,
            'attachments' => $attachments,
        ]);
     }

    /**
     * Request.
     *
     * @param string $method
     * @param array $params
     * @param string $http
     * @param array $fields
     * @return object
     */
    public function request($method, $params, $http = 'GET', $fields = [])
    {
        $url = self::VK_URL . $method . '?' . http_build_query($params)
            . '&v=' . $this->_version . '&access_token=' . $this->_token;

        return $this->curl($url, $http, $fields);
    }
}