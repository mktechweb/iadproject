<?php
namespace App\Controller;

use App\App;
use App\Model\Entity\User;
use App\Model\Manager\UserManager;

class LayoutController extends AppController
{
	public function login() {

		if (isset($_SESSION['auth'])) {
			header("Location: /chat/index");
			die();
		}

		$error_login = '';
		$error_subscribe = '';

		if(!empty($_POST)) {

			$app = App::getInstance();
			$userManager = new UserManager($app->getBdd());

			if (isset($_POST['login'])) {
				$username = isset($_POST['username']) ? $_POST['username'] : NULL;
				$passwd = isset($_POST['passwd']) ? $_POST['passwd'] : NULL;

				$user = $userManager->getUserByLogin($username);
				if ($user) {
					if (password_verify($passwd,$user->getPassword())) {
						$_SESSION['auth'] = $user->getId();
						$_SESSION['login'] = $user->getLogin();
						header("Location: /chat/index");
					} else {
						$error_login = 'incorrect password';
					}
				} else {
					$error_login = 'Invalid IDs or password';
				}
			}

			if (isset($_POST['subscribe'])) {
				if (null !== $_POST['username']
                && null !== $_POST['email']
				&& null !== $_POST['passwd']
				&& null !== $_POST['passwd2']) {
					
					if ($_POST['passwd'] == $_POST['passwd2']) {

						$user = new User([
							"login" => $_POST['username'],
							"email" => $_POST['email'],
							"password" => password_hash($_POST['passwd'],PASSWORD_BCRYPT)
						]);

						$users = $userManager->getAllUsers();
						foreach ($users as $existingUser) {
							if ($existingUser->getLogin() == $user->getLogin()) {
								$error_subscribe = 'username already exists';
								$alreadyExist = true;
							}

                            if ($existingUser->getEmail() == $user->getEmail()) {
                                $error_subscribe = 'email already exists';
                                $alreadyExist = true;
                            }
						}

						if (!isset($alreadyExist)) {
							$userManager->add($user);
							$id = $app->getBdd()->lastInsertId();
							$user->setId($id);
							$_SESSION['auth'] = $user->getId();
                            $_SESSION['login'] = $user->getLogin();
							header("Location: /chat/index");
						}
						
					} else {
						$error_subscribe = 'Passwords must be the same';
					}
				} else {
					$error_subscribe = 'please complete all fields';
				}
			}
			
		}

		$this->render('login', compact('error_login','error_subscribe'));
	}
}