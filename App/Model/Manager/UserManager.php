<?php 

namespace App\Model\Manager;

use App\Repositories\Repository;
use App\Model\Entity\User;

class UserManager {
	private $db;

    public function __construct(Repository $db)
    {
        $this->db = $db;
    }

    public function add(User $user)
  	{
        $query = 'INSERT INTO user(login, email, password) VALUES(?, ?, ?)';
  		$this->db->prepare($query,[$user->getLogin(), $user->getEmail(), $user->getPassword()], true);
  	}

  	public function delete($id)
	{
        $query = 'DELETE FROM user WHERE id = ?';
		$this->db->prepare($query,[(int) $id], true);
	}

	public function update(User $user)
	{
        $query = 'UPDATE user SET login = ?, email = ?, password = ? WHERE id = ?';
		$this->db->prepare($query,[$user->getLogin(), $user->getEmail(), $user->getPassword(), $user->getId()], true);
	}

	public function getUser($id)
	{
        $query = 'SELECT * FROM user WHERE id = ?';
		$data = $this->db->prepare($query,[(int) $id], true);

		return new User($data);
	}

	public function getUserByLogin($login)
	{
        $query = 'SELECT * FROM user WHERE login = ?';
		$data = $this->db->prepare($query,[$login], true);

		if ($data) {
			return new User($data);
		} else {
			return false;
		}
	}

	public function getAllUsers()
	{
		$users = [];

        $query = 'SELECT * FROM user';
		$list = $this->db->prepare($query,[] , false);

		foreach ($list as $data) {
			$users[] = new User($data);
		}

		return $users;
	}
}