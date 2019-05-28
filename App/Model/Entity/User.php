<?php
namespace App\Model\Entity;

use App\Model\Entity;

class User extends Entity
{
	private $_id;
	private $_login;
	private $_email;
	private $_password;

    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = $id;

        return $this;
    }

    public function getLogin()
    {
        return $this->_login;
    }


    public function setLogin($login)
    {
        $this->_login = $login;

        return $this;
    }

    public function getEmail()
    {
        return $this->_email;
    }


    public function setEmail($email)
    {
        $this->_email = $email;

        return $this;
    }
    public function getPassword()
    {
        return $this->_password;
    }

    public function setPassword($password)
    {
        $this->_password = $password;

        return $this;
    }
}