<?php 

namespace App\Model\Manager;

use App\Repositories\Repository;
use App\Model\Entity\Connection;

class ConnectionManager {

	private $db;

    public function __construct(Repository $db)
    {
        $this->db = $db;
    }

    public function add(Connection $connection)
  	{
        $query = 'INSERT INTO connection(user_id, datetime) VALUES(?, ?)';
  		$date = (new \DateTime())->format('Y-m-d H:i:s');
  		$this->db->prepare($query,[$connection->getUserid(), $date], true);
  	}

  	public function update(Connection $connection)
  	{
        $query = 'UPDATE connection SET datetime = ? WHERE user_id = ?';
		$date = (new \DateTime())->format('Y-m-d H:i:s');
		$this->db->prepare($query,[$date, $connection->getUserid()], true);
	}

	public function findByUserId($userId)
	{
        $query = 'SELECT * FROM connection WHERE user_id = ?';
		$data = $this->db->prepare($query,[$userId], true);

		if ($data) {
			return new Connection($data);
		} else {
			return false;
		}
	}

  	public function findAll()
	{
		$connexions = [];

        $query = 'SELECT * FROM connection';
		$list = $this->db->prepare($query,[] , false);

		foreach ($list as $data) {
			$connexions[] = new Connection($data);
		}

		return $connexions;
	}

	public function remove($id)
	{
        $query = 'DELETE FROM connection WHERE id = ?';
		$this->db->prepare($query,[(int) $id], true);
	}
}