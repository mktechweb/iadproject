<?php 

namespace App\Model\Manager;

use App\Repositories\Repository;
use App\Model\Entity\Message;

class MessageManager {
	private $db;

    public function __construct(Repository $db)
    {
        $this->db = $db;
    }

    public function add(Message $message)
  	{
  		$query = 'INSERT INTO message(content, datetime, user_id) VALUES(?, ?, ?)';
  		$date = (new \DateTime())->format('Y-m-d H:i:s');
  		$this->db->prepare($query,[$message->getContent(), $date, $message->getUserid()], true);
  	}


	public function find($id)
	{
        $query = 'SELECT * FROM message WHERE id = ?';
		$data = $this->db->prepare($query,[(int) $id], true);

		return new Message($data);
	}

	public function findAll()
	{
		$messages = [];

        $query = 'SELECT * FROM message';
		$list = $this->db->prepare($query,[] , false);

		foreach ($list as $data) {
			$messages[] = new Message($data);
		}

		return $messages;
	}
}