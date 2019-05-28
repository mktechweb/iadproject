<?php 

namespace App\Model\Manager;

use App\Model\Model;
use App\Model\Entity\Message;

class MessageManager extends Model
{
	private $db;

    public function __construct()
    {
        $this->db = new Model;
    }

    public function add(Message $message)
  	{
        $this->getBdd();
  		$statement = 'INSERT INTO message(content, datetime, user_id) VALUES(?, ?, ?)';
  		$date = (new \DateTime())->format('Y-m-d H:i:s');
  		$this->db->prepare($statement,[$message->getContent(), $date, $message->getUserid()], true);
  	}


	public function find($id)
	{
        $this->getBdd();
		$statement = 'SELECT * FROM message WHERE id = ?';
		$data = $this->db->prepare($statement,[(int) $id], true);

		return new Message($data);
	}

	public function findAll()
	{
        $this->getBdd();
		$messages = [];

		$statement = 'SELECT * FROM message';
		$list = $this->db->prepare($statement,[] , false);


		foreach ($list as $data) {
			$messages[] = new Message($data);
		}


		return $messages;
	}
}