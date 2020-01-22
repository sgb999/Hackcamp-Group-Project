<?php

class ForumData {

    protected $_id, $_name, $_shortDescription, $_description;
    
    public function __construct($dbRow) {
        $this->_id = $dbRow['id'];
        $this->_name = $dbRow['name'];
        $this->_shortDescription = $dbRow['short_description']; //remember to decrypt password
        //$this->_createTime = $dbRow['create_time'];
        if ( array_key_exists('description', $dbRow) ){
        $this->_description = $dbRow['description'];
        } else { $this->_description = '';}
    }

    public function getForumID() {
        return $this->_id;
    }
   
    public function getName() {
       return $this->_name;
    }
    
    public function getShortDescription() {
       return $this->_shortDescription; //remember to decrypt password
    }
    
    public function getDescription() {
       return $this->_description;
    }
}


