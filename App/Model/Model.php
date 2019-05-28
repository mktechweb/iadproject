<?php

namespace App\Model;

use PDO;

class Model
{
    private $_bdd;

    public function __construct()
    {
    }

    private function setBdd()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=chatiad;charset=utf8','root','');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $this->_bdd = $bdd;
    }

    // On récupère la connexion à la BDD
    protected function getBdd()
    {
        if (null == $this->_bdd) {
            $this->setBdd();
        }
        return $this->_bdd;
    }

    public function query($statement, $one = false)
    {
        $req = $this->getBdd()->query($statement);
        if(
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ) {
            return $req;
        }

        $req->setFetchMode(PDO::FETCH_ASSOC);

        if($one) {
            $data = $req->fetch();
        } else {
            $data = $req->fetchAll();
        }
        return $data;
    }

    public function prepare($statement, $attributes, $one = false)
    {

        $req = $this->getBdd()->prepare($statement);
        $res = $req->execute($attributes);
        if(
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ) {
            return $res;
        }
        $req->setFetchMode(PDO::FETCH_ASSOC);

        if($one) {
            $data = $req->fetch();
        } else {
            $data = $req->fetchAll();
        }
        return $data;
    }

    public function lastInsertId(){
        return $this->getBdd()->lastInsertId();
    }
}