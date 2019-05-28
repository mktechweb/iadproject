<?php
namespace App\Controller;


use App\Model\Entity\Message;
use App\Model\Entity\Connection;
use App\Model\Manager\MessageManager;
use App\Model\Manager\UserManager;
use App\Model\Manager\ConnectionManager;

class ChatController extends AppController
{
	public function __construct()
	{
		if (!isset($_SESSION['auth'])) {
			header("Location: /layout/login");
			die();
		}
	}

	public function index(){
		if(!empty($_POST)) {
			$messageManager = new MessageManager();

			$message = new Message([
				"content" => $_POST['content'],
				"userId" => $_SESSION['auth'],
				"login" => $_SESSION['login']
			]);

			$messageManager->add($message);


		}
		$this->render('home');
	}

	public function refresh() 
	{
		$messageManager = new MessageManager();
		$userManager = new UserManager();
        $response = [];

		$messages = $messageManager->findAll();
		foreach ($messages as $message) {
			$user = $userManager->find($message->getUserid());
			$response[$message->getId()]['content'] = $message->getContent();
			$response[$message->getId()]['user'] = $user->getLogin();
			$response[$message->getId()]['datetime'] = $message->getDatetime();
		}

		echo json_encode($response);
	}

	public function checkConnection()
	{
		$connectionManager = new ConnectionManager();
		$userManager = new UserManager();
		$connections = $connectionManager->findAll();
		$connectedUsers = [];
		$new = true;

		foreach ($connections as $connection) {

			if ($connection->getUserid() == $_SESSION['auth']) {
                $connectionManager->update($connection);
				$new = false;			
			}

			$now = new \DateTime();
			$lastupdate = new \DateTime($connection->getDatetime());
			$interval = $lastupdate->diff($now);

			if ($interval->format('%y') > 0
				|| $interval->format('%m') > 0
				|| $interval->format('%d') > 0
				|| $interval->format('%h') > 0
				|| $interval->format('%i') > 5 
			) {
                $connectionManager->remove($connection->getId());
			} else {
				$connectedUsers[] = $userManager->find($connection->getUserid())->getLogin();
			}
		}

		if($new) {
			$newConnection = new Connection([
				"userId" => $_SESSION['auth'],
				"login" => $_SESSION['login']
			]);
            $connectionManager->add($newConnection);
			$connectedUsers[] = $userManager->find($newConnection->getUserid())->getLogin();
		}

		echo json_encode($connectedUsers);
	}

	public function logout()
	{
        $connectionManager = new ConnectionManager();
		$connection = $connectionManager->findByUserId($_SESSION['auth']);
        $connectionManager->remove($connection->getId());
		unset($_SESSION['auth']);
		unset($_SESSION['login']);
		header("Location: /layout/login");
	}
}