<!DOCTYPE html>
<html xmlns = "http://www.w3.org/1999/xhtml" lang= "en" xml : lang="en" >
<head>
<meta http-equiv="content-type" content="text/html; charset = utf-8" />
<title>Reset database</title>
<link rel="stylesheet" href= "style.css"/>
</head>
<body class="bd5">
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
         if(isset($_POST["submit"]))
       {  
          $query = "DROP TABLE $table";
          $result = mysqli_query($conn, $query);
          if(!$result)
          {
           echo"There is no data to reset
                <p><a href = 'index.html'>Return to Home Page</a></p>";
           }
         else{
         echo"Database is reset successfuly !
             <p><a href = 'index.html'>Return to Home Page</a></p>";
           }
     }
}
//Close database connection
mysqli_close($conn);
?>
</div> 
</body>
</html>