<?php 

namespace App\Model\Manager;

use App\Model\Model;
use App\Model\Entity\User;

class UserManager extends Model
{
	private $db;

    public function __construct()
    {
        $this->db = new Model;
    }

    public function add(User $user)
  	{
  	    $this->getBdd();
  		$statement = 'INSERT INTO user(login, email, password) VALUES(?, ?, ?)';
  		$this->db->prepare($statement,[$user->getLogin(), $user->getEmail(), $user->getPassword()], true);
  	}

  	public function delete($id)
	{
        $this->getBdd();
		$statement = 'DELETE FROM user WHERE id = ?';
		$this->db->prepare($statement,[(int) $id], true);
	}

	public function update(User $user)
	{
        $this->getBdd();
		$statement = 'UPDATE user SET login = ?, email = ?, password = ? WHERE id = ?';
		$this->db->prepare($statement,[$user->getLogin(), $user->getEmail(), $user->getPassword(), $user->getId()], true);
	}

	public function find($id)
	{
        $this->getBdd();
		$statement = 'SELECT * FROM user WHERE id = ?';
		$data = $this->db->prepare($statement,[(int) $id], true);

		return new User($data);
	}

	public function findByLogin($login)
	{
        $this->getBdd();
		$statement = 'SELECT * FROM user WHERE login = ?';
		$data = $this->db->prepare($statement,[$login], true);

		if ($data) {
			return new User($data);
		} else {
			return false;
		}
	}

	public function findAll()
	{
        $this->getBdd();
		$users = [];

		$statement = 'SELECT * FROM user';
		$list = $this->db->prepare($statement,[] , false);

		foreach ($list as $data) {
			$users[] = new User($data);
		}

		return $users;
	}
}