# FinalExam
final exam for CSIT-207


index.php
--------------
main page:
responds to the following GET endpoints:
/quarterbacks                   #returns quarterbacks table joined with teams table

/teams                          #returns teams table

/stadiums                       #returns stadiums table joined with teams table

/quarterbacks/{orderByStat}     #querys quarterbacks table, returns ordered list by specified stat

/teams/{conference}             #querys teams table, returns AFC or NFC teams

/stadiums/capacity              #querys stadium table, orders by stadium capacity

/stadiums/indoor                #querys stadium table, lists the indoor stadiums

/quarterbacks/teams/stadiums    #joins all 3 tables


responds to the following POST request:
/addQb  #allows you to add new QB information you would like posted to database
        #click button on /addQb posts data brings you to /postQb page

Quarterback.php Class
-----------------------
Provides the methods and properties to add a new quarterback to the database in the proper format
Links to the db class for access to the database when adding data

api.php Class
-----------------
Handles all the GET and POST requests with access to the footballDB.

db.php Class
---------------
Class used to connect to footballDB
This class is used by both the API, and Quarterbacks class to GET and POST data to footballDB.
