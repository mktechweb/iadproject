<?php
namespace App;

/*
 * This class loads autoloaders and an instance of the database
 */
class App 
{
	public static function load()
    {
        if(!isset($_SESSION)) {
		    session_start();
		}
		// chargement de l'autoloader
        require APPDIR .'/Autoloader.php';
        Autoloader::register();
    }
}