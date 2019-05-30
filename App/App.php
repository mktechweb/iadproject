<?php
namespace App;

use App\Repositories\Repository;
use PDO;

/*
 * Cette classe charge l'autoloader puis instancie la base de données
 */
class App 
{
	private static $_instance;
	private $db_instance;

	public static function getInstance(){
		if(is_null(self::$_instance)){
            self::$_instance = new App();
        }
        return self::$_instance;
	}

	public static function load()
    {
        if(!isset($_SESSION)) {
		    session_start();
		}
		// chargement de l'autoloader
        require APPDIR .'/Autoloader.php';
        Autoloader::register();
    }

    public function getBdd()
    {
       // instanciation de la BDD si elle n'existe pas
        if(is_null($this->db_instance)) {
            $this->db_instance = new Repository;
        }
        return $this->db_instance;
    }
}