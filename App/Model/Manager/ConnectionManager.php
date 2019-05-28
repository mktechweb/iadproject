<?php 

namespace App\Model\Manager;

use App\Model\Model;
use App\Model\Entity\Connection;

class ConnectionManager extends Model
{
	private $db;

    public function __construct()
    {
        $this->db = new Model;
    }

    public function add(Connection $connection)
  	{
        $this->getBdd();
  		$statement = 'INSERT INTO connection(user_id, datetime) VALUES(?, ?)';
  		$date = (new \DateTime())->format('Y-m-d H:i:s');
  		$this->db->prepare($statement,[$connection->getUserid(), $date], true);
  	}

  	public function update(Connection $connection)
  	{
        $this->getBdd();
		$statement = 'UPDATE connection SET datetime = ? WHERE user_id = ?';
		$date = (new \DateTime())->format('Y-m-d H:i:s');
		$this->db->prepare($statement,[$date, $connection->getUserid()], true);
	}

	public function findByUserId($userId)
	{
        $this->getBdd();
		$statement = 'SELECT * FROM connection WHERE user_id = ?';
		$data = $this->db->prepare($statement,[$userId], true);

		if ($data) {
			return new Connection($data);
		} else {
			return false;
		}
	}

  	public function findAll()
	{
        $this->getBdd();
		$connexions = [];

		$statement = 'SELECT * FROM connection';
		$list = $this->db->prepare($statement,[] , false);

		foreach ($list as $data) {
			$connexions[] = new Connection($data);
		}

		return $connexions;
	}

	public function remove($id)
	{
        $this->getBdd();
		$statement = 'DELETE FROM connection WHERE id = ?';
		$this->db->prepare($statement,[(int) $id], true);
	}
}