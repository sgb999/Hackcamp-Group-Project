<?php

require_once ('Models/DataSet.php');
require_once ('Models/ForumData.php');

class ForumsDataSet extends DataSet {

    public function __construct() {
        parent::__construct();
    }

    // overrides from DataSet
    protected function convertToData($row) {
        return new ForumData($row);
    }

    public function fetchAll() {
        $sqlQuery = 'SELECT * FROM forums';

        return $this->fetchQuery($sqlQuery);
    }

    public function fetchIDNameAndShortDescription() {
        $sqlQuery = 'SELECT id, name, short_description FROM forums';

        return $this->fetchQuery($sqlQuery);
    }

    public function fetchDataByID($id) {
        $sqlQuery = 'SELECT * FROM forums WHERE id=' . $id . '';

        $dataSet = $this->fetchQuery($sqlQuery);
        return $dataSet;
    }
}


