# FinalExam
final exam for CSIT-207


index.php
--------------
main page
responds to the following GET endpoints:
/quarterbacks
/teams
/stadiums
/quarterbacks/{orderByStat}
/teams/{conference}
/stadiums/capacity
/stadiums/indoor
/quarterbacks/teams/stadiums

responds to the following POST request:
/addQb  #allows you to add new information you would like posted to database
        #click button on /addQb posts data brings you to /postQb page

Quarterback.php Class
-----------------------
Provides the methods and properties to add a new quarterback to the database in the proper format

api.php Class
-----------------
Handles all the GET and POST requests with access to the footballDB.

db.php Class
---------------
Class used to connect to footballDB
This class is used by both the API, and Quarterbacks class to GET and POST data to footballDB.
