<!DOCTYPE html>
<html xmlns = "http://www.w3.org/1999/xhtml" lang= "en" xml : lang="en" >
<head>
<meta http-equiv="content-type" content="text/html; charset = utf-8" />
<title>Search Status Result Page</title>
<link rel="stylesheet" href= "style.css"/>
</head>
<body class="bd3">
<h1>Status Information</h1>
<div class="content">
<?php
 require_once ("../../files/personaldata.php"); //please make sure the path is correct

        
        // Establish database connection
        $conn = mysqli_connect($local_host, $user, $password, $database);
        
        //Check if connection is successful
        if(!$conn)
       {
           die("Connection failed");
        }
           else
{
         if(isset($_GET["Search"]))
    {
           //Get data from the form 
           $searchstatus = $_GET["Search"];
           $query = "SELECT * FROM $table WHERE st = '$searchstatus'";
           if(empty($searchstatus)){
            echo"<p>The search string is empty. Please enter a keyword to search.
            <p><a href='index.html'>Return to the Home page</a>
            <p><a href='searchstatusform.html'>Search Status Page</a></p>";
            exit;}
           
            $match = mysqli_query($conn, $query);

            $query2 = "SHOW TABLES LIKE'statuses'";
            $showtable = mysqli_query($conn, $query2);

            if(mysqli_num_rows($showtable) == 0)
            {
          echo"<p>No status found in the system. Please go to the post status page to post one.
           <p><a href='poststatusform.php'>Post Status Page</a></p>";
            exit;}
         
           if(mysqli_num_rows($match) == 0){
            echo"<p>Status not found. Please try a different keyword.
              <p><a href='index.html'>Return to the Home page</a>
            <p><a href='searchstatusform.html'>Search Status Page</a></p>";
            }
            while ($row = mysqli_fetch_assoc($match)){
                  echo"<p>Status: {$row['st']}
                  <p>Status Code: {$row['stcode']}
                  <br></br>
                  <p>Share: {$row['share']}</p>";

                 $date_posted = DateTime::createFromFormat('d/m/Y', $row['date']);
                  echo "<p>Date Posted: {$date_posted->format('F d, Y')}      
                  <p>Permission: {$row['permission']}

            <p><div id='float-left'><a href='searchstatusform.html'>Search for another status</a></div>
            <div id='float-right'><a href='index.html'>Return to Home Page</a></div></p>";
               
             }   
        }
      }
 
//Close database connection
mysqli_close($conn);
?>
</div> 
</body>
</html>