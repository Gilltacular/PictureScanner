<?php
    include_once "includes/db_connect.php";
    include_once "includes/functions.php";
    include_once "includes/header.php";
?>

<!DOCTYPE html>
<html lang="en">
  <body>
    <!-- About this project information -->
    <div class="container-fluid">
      <div class="page-header">
        <p><h3>The core tenants of the Picture Scanner system are:</h3></p>
      </div>
      <div class="col-sm-4">
        <h2>POWER:</h2> Do all the things! We developed the Picture Scanner system to be a frighteningly powerful tool and since we threw the switch and our beautiful monster was unleashed on the world it has been worthy of its name. The Picture Scanner system is one of those tools that you will wonder how you ever got along without it. The more it grows, the better it gets. “You ain't seen nothin’ yet.”
      </div>
      <div class="col-sm-4">
        <h2>SIMPLICITY:</h2> Keep it simple stupid! The KISS principle states that most systems work best if they are kept simple rather than made complicated; therefore simplicity should be a key goal in design and unnecessary complexity should be avoided. The development team behind the Picture Scanner web-application are devoted followers of this idea and strive to both be as simple as possible for its users as well as in the frameworks and programming genius that makes it up.
      </div>
      <div class="col-sm-4">
        <h2>EASE OF USE:</h2> To allow for the greatest benefit with the lowest amount of expended effort, the Picture Scanner system is created with the users in mind. New and existing features focus on being easy to understand at a glance and intuitive to use letting you spend less time trying to figure it out and more time just letting it make life easy for your project needs.
      </div>
    </div>
    <div class="page-header"><!-- This is just for formatting --></div></br></br>
    <!-- Current Development Progress Section -->
    <div class="container">
      <div class="jumbotron">
        <div class="page-header">
          <p>The features in development for the current version of Picture Scanner and their current status are as follows:</p>
        </div>
        <div class="container-fluid">
          <div class="col-sm-4">
            <ul class="list-group">
              <li class="list-group-item-success">
                Green = Completed
              </li>
            </ul>
          </div>
          <div class="col-sm-4">
            <ul class="list-group">
              <li class="list-group-item-info">
                Blue = Incomplete (WIP)
              </li>
            </ul>
          </div>
          <div class="col-sm-4">
            <ul class="list-group">
              <li class="list-group-item-warning">
                Yellow = Not working on yet
              </li>
            </ul>
          </div>
        </div>
        <li class="list-group-item list-group-item-info">
          Users are able to upload an image
        </li>
        <li class="list-group-item list-group-item-info">
          Database stores the image in the user's photo table
        </li>
        <li class="list-group-item list-group-item-info">
          Users are able to search for an image based on search criteria
        </li>
        <li class="list-group-item list-group-item-info">
          System uses the search criteria to retrieve images from the database with the matching criteria
        </li>
        <li class="list-group-item list-group-item-info">
          System displays the images to the user
        </li>
        <li class="list-group-item list-group-item-success">
          Navigation bar has been implemented
        </li>
        <li class="list-group-item list-group-item-success">
          Users are able to sign up on the website
        </li>
        <li class="list-group-item list-group-item-success">
          Users are able to login to the website
        </li>
        <li class="list-group-item list-group-item-success">
          Application signup is secure from common malicious security threats and exploits
        </li>
        <li class="list-group-item list-group-item-success">
          Application's login is secure from common malicious security threats and exploits
        </li>
        <li class="list-group-item list-group-item-success">
          Database is secure from common malicious security threats and exploits
        </li>
        <li class="list-group-item list-group-item-warning">
          Users are able to delete an image from the database
        </li>
      </div>
    </div>
    <!-- Future Development Goals -->
    <div class="container">
      <div class="jumbotron">
        <p>The features in development for future versions of Picture Scanner are as follows:</p>
        <li class="list-group-item">
          Image's color profile displayed
        </li>
        <li class="list-group-item">
          Scanning algorithm improved to handle more formats and collect more data from photos
        </li>
        <li class="list-group-item">
          more search options
        </li>
        <li class="list-group-item">
          Beef up login notifications and profile options
        </li>
        <li class="list-group-item">
          Fix issue with signup sometimes giving an error and redirecting back to success screen
        </li>
        <li class="list-group-item">
          Fix issue with signup sometimes not taking valid password input in Firefox web browser
        </li>
        <li class="list-group-item">
          Apply auto folder generation and categorization scheme for photo storage in the file system utilizing binary search for quicker sort/traversal of large photo databases
        </li>
      </div>
    </div>
    <!-- Disclaimer -->
    <div class="container">
      <li class="list-group-item list-group-item-danger">
        <h3>Picture Scanner is currently an alpha project. Ye be warned! Please don't blame us if something important gets lost or broken.</h3>
      </li>
    </div><br><br><br><br>
  </body>
</html>
