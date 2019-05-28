<?php
namespace App\Model;

class Entity {

	public function __construct(array $data = []) {
		$this->hydrate($data);
	}

	public function hydrate(array $data)
	{
  		foreach ($data as $key => $value) {
		    // On récupère le nom du setter correspondant à l'attribut.
		    $setMethod = 'set'.ucfirst(str_replace('_', '', $key));
        
		    // Si le setter correspondant existe.
		    if (method_exists($this, $setMethod)) {
		      // On appelle le setter.
		      $this->$setMethod($value);
		    }
  		}
  	}
}