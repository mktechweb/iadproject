<?php

namespace App\Repositories;

use PDO;

class Repository
{
    private $_bdd;

    public function setBdd()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=chatiad;charset=utf8','root','');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $this->_bdd = $bdd;
    }

    // On récupère la connexion à la BDD
    public function getBDD()
    {
        if (null == $this->_bdd) {
            $this->setBdd();
        }
        return $this->_bdd;
    }

    public function query($statement, $one = false)
    {
        $request = $this->getBDD()->query($statement);

        $request->setFetchMode(PDO::FETCH_ASSOC);
        
        if($one) {
            $data = $request->fetch();
        } else {
            $data = $request->fetchAll();
        }
        return $data;
    }

    public function prepare($query, $attributes, $one = false)
    {
        $req = $this->getBDD()->prepare($query);
        $res = $req->execute($attributes);

        if(strpos($query, 'UPDATE') === 0
            || strpos($query, 'INSERT') === 0
            || strpos($query, 'DELETE') === 0) {
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
        return $this->getBDD()->lastInsertId();
    }
}