<?php

require_once __DIR__.'/db.php';
require __DIR__.'/quarterback.php';

class API {
    private $method;
    private $request;
    private $requestList;

    public function __construct(string $method, string $request) {
        $this->method = $method;
        $this->request = $request;
    }

    //use explode method to obtain endpoints from $request
    public function explodeRequest() {
        $this->requestList = explode("/", $this->request);
    }

    //Display form to add quarterback
    public function addQuarterback() {

        ?>
        <h1>Add Quarterback</h1>
        <form action="/postQb" method="post">
            First Name: <input type="text" name="firstName" /><br />
            Last Name: <input type="text" name="lastName" /><br />
            Team: <input type="text" name="teamName" /><br />
            Games Played: <input type="text" name="gamesPlayed" /><br />
            Passing Yards: <input type="text" name="passingYds" /><br />
            Passing TD's: <input type="text" name="passingTd" /><br />
            Rushing Yards: <input type="text" name="rushingYds" /><br />
            Rushing TD's: <input type="text" name="rushingTd" /><br />
            <input type="submit" value="Post" />
        </form>

        <?php
    }


    public function getPostRequest() {
        //GET Requests (if $method is GET)
        if($this->method == 'GET'){
            if(count($this->requestList) == 1) {
                //do nothing
            }

            //if endpoint is only 1 word /{tablename}
            if(count($this->requestList) == 2) {
                //for endpoint "/quarterbacks" or "/stadiums"
                if($this->requestList[1] == 'quarterbacks' || $this->requestList[1] == 'stadiums'){
                    $table = $this->requestList[1];
                    $sql = "SELECT $table.* , teams.name FROM $table " .
                    "LEFT JOIN teams ON $table.team_id=teams.id";
                    try {
                        //Get DB object
                        $db = new db();
                        //Connect to DB
                        $db = $db->connect();
                        //Prepare sql statement
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        //header variable used for printing column headers 
                        $header = false;

                        //display db info as a table
                        echo "<table>";
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            if($header == false) {
                                echo '<tr>';
                                foreach($row as $key => $value) {
                                    echo "<th>{$key}</th>";
                                }
                                echo '</tr>';
                                $header = true;
                            }
                            echo "<tr>";
                            foreach($row as $value) {
                                echo "<td>{$value}</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";


                        //Close connection
                        $db = null;
                    } catch (PDOException $ex) {
                        echo "error: ".$ex->getMessage();
                    }
                    
                }
                //for endpoint "/teams"
                if($this->requestList[1] == 'teams') {
                    $sql = "SELECT * FROM teams ";
                    try {
                        //Get DB object
                        $db = new db();
                        //Connect to DB
                        $db = $db->connect();
                        //Prepare sql statement
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        //header variable used for printing column headers 
                        $header = false;

                        //display db info as a table
                        echo "<table>";
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            if($header == false) {
                                echo '<tr>';
                                foreach($row as $key => $value) {
                                    echo "<th>{$key}</th>";
                                }
                                echo '</tr>';
                                $header = true;
                            }
                            echo "<tr>";
                            foreach($row as $value) {
                                echo "<td>{$value}</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";


                        //Close connection
                        $db = null;
                    } catch (PDOException $ex) {
                        echo "error: ".$ex->getMessage();
                    }
                    
                }
                //special case, after adding QB to list button click will result in
                //endpoint of "/quarterbacks?"
                if($this->requestList[1] == 'quarterbacks?')
                {
                    $sql = "SELECT quarterbacks.* , teams.name FROM quarterbacks " .
                    "LEFT JOIN teams ON quarterbacks.team_id=teams.id";
                    try {
                        //Get DB object
                        $db = new db();
                        //Connect to DB
                        $db = $db->connect();
                        //Prepare sql statement
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        //header variable used for printing column headers 
                        $header = false;

                        //display db info as a table
                        echo "<table>";
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            if($header == false) {
                                echo '<tr>';
                                foreach($row as $key => $value) {
                                    echo "<th>{$key}</th>";
                                }
                                echo '</tr>';
                                $header = true;
                            }
                            echo "<tr>";
                            foreach($row as $value) {
                                echo "<td>{$value}</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";


                        //Close connection
                        $db = null;
                    } catch (PDOException $ex) {
                        echo "error: ".$ex->getMessage();
                    }
                }


            }

            //if endpoint is 2 words /{tablename}/{otherInfo}
            if(count($this->requestList) == 3) {
                //if endpoint is "/quarterbacks/{someOtherInfo}"
                if($this->requestList[1] == 'quarterbacks') {
                    $col = $this->requestList[2];
                    //return quarterbacks descending from stat selected
                    $sql = "SELECT first_name, last_name, games_played, passing_yds, passing_td, " . 
                    " rushing_yds, rushing_td FROM quarterbacks ORDER BY $col DESC";
                    try {
                        //Get DB object
                        $db = new db();
                        //Connect to DB
                        $db = $db->connect();
                        //Prepare sql statement
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        //header variable used for printing column headers 
                        $header = false;

                        //display db info as a table
                        echo "<table>";
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            if($header == false) {
                                echo '<tr>';
                                foreach($row as $key => $value) {
                                    echo "<th>{$key}</th>";
                                }
                                echo '</tr>';
                                $header = true;
                            }
                            echo "<tr>";
                            foreach($row as $value) {
                                echo "<td>{$value}</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";


                        //Close connection
                        $db = null;
                    } catch (PDOException $ex) {
                        echo "error: ".$ex->getMessage();
                    }
                   
                }
                //if endpoint is "/teams/{someOtherInfo}"
                if($this->requestList[1] == 'teams') {
                    $col = $this->requestList[2];
                    //return team info based on conference selected
                    if($col == 'AFC' || $col == 'NFC') {
                        $sql = "SELECT * FROM teams WHERE conference='$col' ";
                        try {
                            //Get DB object
                        $db = new db();
                        //Connect to DB
                        $db = $db->connect();
                        //Prepare sql statement
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        //header variable used for printing column headers 
                        $header = false;

                        //display db info as a table
                        echo "<table>";
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            if($header == false) {
                                echo '<tr>';
                                foreach($row as $key => $value) {
                                    echo "<th>{$key}</th>";
                                }
                                echo '</tr>';
                                $header = true;
                            }
                            echo "<tr>";
                            foreach($row as $value) {
                                echo "<td>{$value}</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";


                        //Close connection
                        $db = null;
                        } catch (PDOException $ex) {
                            echo "error: ".$ex->getMessage();
                        }
                        
                    }

                }
                //if endpoint is "/stadiums/{someOtherInfo}"
                if($this->requestList[1] == 'stadiums') {
                    $col = $this->requestList[2];
                    //return stadiums descending based on capacity
                    if($col == 'capacity') {
                        $sql = "SELECT stadiums.* , teams.name FROM stadiums LEFT JOIN " . 
                        "teams ON stadiums.team_id=teams.id ORDER BY stadiums.$col DESC ";
                        try {
                            //Get DB object
                            $db = new db();
                            //Connect to DB
                            $db = $db->connect();
                            //Prepare sql statement
                            $stmt = $db->prepare($sql);
                            $stmt->execute();
                            //header variable used for printing column headers 
                            $header = false;

                            //display db info as a table
                            echo "<table>";
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                if($header == false) {
                                    echo '<tr>';
                                    foreach($row as $key => $value) {
                                        echo "<th>{$key}</th>";
                                    }
                                    echo '</tr>';
                                    $header = true;
                                }
                                echo "<tr>";
                                foreach($row as $value) {
                                    echo "<td>{$value}</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</table>";


                            //Close connection
                            $db = null;
                        } catch (PDOException $ex) {
                            echo "error: ".$ex->getMessage();
                        }
                    }
                    //return list of all indoor stadiums
                    if($col == 'indoor') {
                        $sql = "SELECT stadiums.* , teams.name FROM stadiums LEFT JOIN " . 
                        " teams ON stadiums.team_id=teams.id WHERE indoor='Yes' ";
                        try {
                            //Get DB object
                            $db = new db();
                            //Connect to DB
                            $db = $db->connect();
                            //Prepare sql statement
                            $stmt = $db->prepare($sql);
                            $stmt->execute();
                            //header variable used for printing column headers 
                            $header = false;

                            //display db info as a table
                            echo "<table>";
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                if($header == false) {
                                    echo '<tr>';
                                    foreach($row as $key => $value) {
                                        echo "<th>{$key}</th>";
                                    }
                                    echo '</tr>';
                                    $header = true;
                                }
                                echo "<tr>";
                                foreach($row as $value) {
                                    echo "<td>{$value}</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</table>";


                            //Close connection
                            $db = null;
                        } catch (PDOException $ex) {
                            echo "error: ".$ex->getMessage();
                        }
                    }
                }
            }
            //if endpoint is 3 words "/quarterbacks/teams/stadiums"
            //join and display all 3 tables
            if(count($this->requestList) == 4) {
                $col1 = $this->requestList[1];
                $col2 = $this->requestList[2];
                $col3 = $this->requestList[3];
                if($col1 == 'quarterbacks' && $col2 == 'teams' && $col3 == 'stadiums') {
                    $sql = "SELECT CONCAT(quarterbacks.first_name, ' ', quarterbacks.last_name) AS qb_name, " . 
                        " quarterbacks.games_played, quarterbacks.passing_yds, quarterbacks.passing_td, " . 
                        " quarterbacks.rushing_td , teams.* , stadiums.* FROM teams LEFT JOIN " . 
                        " quarterbacks ON teams.id=quarterbacks.team_id LEFT JOIN " . 
                        " stadiums ON teams.id=stadiums.team_id ";
                        try {
                            //Get DB object
                            $db = new db();
                            //Connect to DB
                            $db = $db->connect();
                            //Prepare sql statement
                            $stmt = $db->prepare($sql);
                            $stmt->execute();
                            //header variable used for printing column headers 
                            $header = false;

                            //display db info as a table
                            echo "<table>";
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                if($header == false) {
                                    echo '<tr>';
                                    foreach($row as $key => $value) {
                                        echo "<th>{$key}</th>";
                                    }
                                    echo '</tr>';
                                    $header = true;
                                }
                                echo "<tr>";
                                foreach($row as $value) {
                                    echo "<td>{$value}</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</table>";


                            //Close connection
                            $db = null;
                        } catch (PDOException $ex) {
                            echo "error: ".$ex->getMessage();
                        }
                }
            }
        }

        //POST Requests (if $method is POST)
        if($this->method == 'POST'){
            if($this->requestList[1] == 'postQb') {
                $newQb = new Quarterback(
                    $_POST['firstName'],
                    $_POST['lastName'],
                    $_POST['passingYds'],
                    $_POST['passingTd'],
                    $_POST['gamesPlayed'],
                    $_POST['rushingYds'],
                    $_POST['rushingTd'],
                    $_POST['teamName']
                );
                //check to make sure data is ok before adding to db
                $newQb->getTeamId();
                $newQb->checkData();
                //add data to db
                $newQb->updateQbTable();

                echo "<h2>Update Successful!</h2><br>";
                echo "Click button to see updated QB List";
                ?>
                <form action="/quarterbacks" method="get">
                    <input type="submit" value="See QB List" />
                </form>

                <?php
                
            }

            
        }
    }

    //Read Properties for method and request
    public function getMethod() {
        return $this->method;
    }

    public function getRequest() {
        return $this->request;
    }


}


?>