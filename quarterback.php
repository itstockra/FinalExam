<?php

require_once __DIR__.'/db.php';

class Quarterback {
    private $team_id;
    private $first_name;
    private $last_name;
    private $passing_yds;
    private $passing_td;
    private $games_played;
    private $rushing_yds;
    private $rushing_td;
    private $teamName;


    public function __construct(
        string $first_name,
        string $last_name,
        int $passing_yds,
        int $passing_td,
        int $games_played,
        int $rushing_yds,
        int $rushing_td,
        string $teamName
    ) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->passing_yds = $passing_yds;
        $this->passing_td = $passing_td;
        $this->games_played = $games_played;
        $this->rushing_yds = $rushing_yds;
        $this->rushing_td = $rushing_td;
        $this->teamName = $teamName;
    }

    public function updateQbTable() {
        $sql = "INSERT INTO quarterbacks (team_id, first_name, last_name, passing_yds, " . 
        " passing_td, games_played, rushing_yds, rushing_td) VALUES (:team_id, :first_name, " . 
        " :last_name, :passing_yds, :passing_td, :games_played, :rushing_yds, :rushing_td)";

        try {
            //get DB object
            $db = new db();
            //connect to DB
            $db = $db->connect();
            //prepare sql statement and bind parameters
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':team_id',$this->team_id);
            $stmt->bindParam(':first_name',$this->first_name);
            $stmt->bindParam(':last_name',$this->last_name);
            $stmt->bindParam(':passing_yds',$this->passing_yds);
            $stmt->bindParam(':passing_td',$this->passing_td);
            $stmt->bindParam(':games_played',$this->games_played);
            $stmt->bindParam(':rushing_yds',$this->rushing_yds);
            $stmt->bindParam(':rushing_td',$this->rushing_td);
            $stmt->execute();

            //Close connection after adding data
            $db = null;

        } catch(PDOException $ex) {
            echo 'error: '.$ex->getMessage();
        }
    }

    //check data entered by user if nothing has been
    //entered fill out with default values
    public function checkData() {
        if($this->first_name == NULL) {
            $this->first_name = "first_name";
        }
        if($this->last_name == NULL) {
            $this->last_name = "last_name";
        }
        if($this->passing_yds == NULL) {
            $this->passing_yds = 0;
        }
        if($this->passing_td == NULL) {
            $this->passing_td = 0;
        }
        if($this->games_played == NULL) {
            $this->games_played = 0;
        }
        if($this->rushing_yds == NULL) {
            $this->rushing_yds = 0;
        }
        if($this->rushing_td == NULL) {
            $this->rushing_td = 0;
        } 
        
    }

    //Set team_id dependent on the team name supplied
    public function getTeamId() {
        switch($this->teamName) {
            case "Arizona Cardinals":
                $this->team_id = 1;
                break;
            case "Atlanta Falcons":
                $this->team_id = 2;
                break;
            case "Baltimore Ravens":
                $this->team_id = 3;
                break;
            case "Buffalo Bills":
                $this->team_id = 4;
                break;
            case "Carolina Panthers":
                $this->team_id = 5;
                break;
            case "Chicago Bears":
                $this->team_id = 6;
                break;
            case "Cincinnati Bengals":
                $this->team_id = 7;
                break;
            case "Cleveland Browns":
                $this->team_id = 8;
                break;
            case "Dallas Cowboys":
                $this->team_id = 9;
                break;
            case "Denver Broncos":
                $this->team_id = 10;
                break;
            case "Detroit Lions":
                $this->team_id = 11;
                break;
            case "Green Bay Packers":
                $this->team_id = 12;
                break;
            case "Houston Texans":
                $this->team_id = 13;
                break;
            case "Indianapolis Colts":
                $this->team_id = 14;
                break;
            case "Jacksonville Jaguars":
                $this->team_id = 15;
                break;
            case "Kansas City Chiefs":
                $this->team_id = 16;
                break;
            case "Las Vegas Raiders":
                $this->team_id = 17;
                break;
            case "Los Angeles Chargers":
                $this->team_id = 18;
                break;
            case "Los Angeles Rams":
                $this->team_id = 19;
                break;
            case "Miami Dolphins":
                $this->team_id = 20;
                break;
            case "Minnesota Vikings":
                $this->team_id = 21;
                break;
            case "New England Patriots":
                $this->team_id = 22;
                break;
            case "New Orleans Saints":
                $this->team_id = 23;
                break;
            case "New York Giants":
                $this->team_id = 24;
                break;
            case "New York Jets":
                $this->team_id = 25;
                break;
            case "Philadelphia Eagles":
                $this->team_id = 26;
                break;
            case "Pittsburgh Steelers":
                $this->team_id = 27;
                break;
            case "San Francisco 49ers":
                $this->team_id = 28;
                break;
            case "Seattle Seahawks":
                $this->team_id = 29;
                break;
            case "Tampa Bay Buccaneers":
                $this->team_id = 30;
                break;
            case "Tennessee Titans":
                $this->team_id = 31;
                break;
            case "Washington Football Team":
                $this->team_id = 32;
                break;

        }
    }

}


?>