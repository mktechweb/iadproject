<?php
namespace App\Model\Entity;

use App\Model\Entity;

class Message extends Entity
{
	private $_id;
	private $_userId;
	private $_datetime;
	private $_content;


    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = $id;

        return $this;
    }

    public function getUserid()
    {
        return $this->_userId;
    }

    public function setUserid($userId)
    {
        $this->_userId = $userId;

        return $this;
    }

    public function getDatetime()
    {
        return $this->_datetime;
    }

    public function setDatetime($datetime)
    {
        $this->_datetime = $datetime;

        return $this;
    }

    public function getContent()
    {
        return $this->_content;
    }

    public function setContent($content)
    {
        $this->_content = $content;

        return $this;
    }
}