<?php

//Create DB class
//Connects to footballDB 

class db {
    //Properties
    private $dbhost = 'localhost';
    private $dbuser = 'phpmyadmin';
    private $dbpass = 'sqlpass';
    private $dbname = 'footballDB';

    //Connect to footballDB
    public function connect() {
        $mysqlConnectString = "mysql:host=$this->dbhost;dbname=$this->dbname;";
        $dbConnection = new PDO($mysqlConnectString, $this->dbuser, $this->dbpass);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }

}


?>