<?php

class Client {

    protected $_id, $_name;

    public function __construct($dbRow) {
        $this->_id = $dbRow['clientID'];
        $this->_name = $dbRow['clientName'];
    }

    public function getClientID() {
        return $this->_id;
    }
   
    public function getName() {
       return $this->_name;
    }

}


