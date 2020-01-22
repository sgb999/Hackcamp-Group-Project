<?php

class User {

    protected $_id, $_name, $_firstName, $_lastName,
        $_password, $_email, $_userLevel, $_date;

    public function __construct($dbRow) {
        $this->_id = $dbRow['userID'];
        $this->_name = $dbRow['username'];
        $this->_firstName = $dbRow['firstName'];
        $this->_lastName = $dbRow['lastName'];
        $this->_password = $dbRow['pass'];
        $this->_email = $dbRow['email'];
        $this->_userLevel = $dbRow['userLevel'];
        $this->_date = $dbRow['userDate'];
    }

    public function getUserID() {
        return $this->_id;
    }
   
    public function getName() {
       return $this->_name;
    }

    public function getFirstName() {
        return $this->_firstName;
    }

    public function getLastName() {
        return $this->_lastName;
    }

    public function getFullName() {
        return $this->_firstName . ' ' . $this->_lastName;
    }

    public function getPassword() {
        return $this->_password;
    }

    public function getEmail() {
        return $this->_email;
    }

    public function getLevel() {
        return $this->_userLevel;
    }

    public function getDateMade() {
        return $this->_date;
    }
}


