<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Process Post Status</title>
<link rel="stylesheet" href= "style.css"/>
</head>
<body class="bd3">
    <div class="content">
        <?php
         require_once ("../../files/personaldata.php"); //please make sure the path is correct

        
        // Establish database connection
        $conn = mysqli_connect($local_host, $user, $password, $database);

        // Check if connection is successful
        if (!$conn) {
            die("Connection failed");
        } 
            else 
        {
                           

            // Check if all required fields are provided
            if (isset($_POST["stcode"]) && isset($_POST["st"]) && isset($_POST["share"]) && isset($_POST["date"]) && isset($_POST["permission"])) 
        {
                $status_code = $_POST["stcode"];
                $status = $_POST["st"];
                $share =  $_POST["share"];
                $date = $_POST["date"];
                $permission = implode(",", $_POST["permission"]);

                $sql = "CREATE TABLE IF NOT EXISTS statuses(
                 stcode varchar(5) NOT NULL,
                 st varchar(50) NOT NULL, 
                 share ENUM('University', 'Class', 'Private') NOT NULL,
                 date varchar(10) NOT NULL,
                 permission set('Allow Like','Allow Comments','Allow Share') NOT NULL,
                 PRIMARY KEY(stcode));";
                $result = mysqli_query($conn, $sql);


                // Check status code format
                if (!preg_match("/^S\d{4}$/", $status_code)) {
                    echo "<p>Wrong format! The status code must start with an 'S' followed by four digits, like 'S0001'.
                    <p><a href='poststatusform.php'>Post status page</a>
                    <p><a href='index.html'>Return to the Home page</a></p>";
                     exit;
                }

                // Check if status code already exists
                $check_query = "SELECT * FROM $table WHERE stcode = '$status_code'";
                $check_result = mysqli_query($conn, $check_query);
                if (mysqli_num_rows($check_result) > 0) {
                    echo "<p>The status code already exists. Please try another one!
                    <p><a href='poststatusform.php'>Post status page</a>
                    <p><a href='index.html'>Return to the Home page</a></p>";
                    exit;
                }

                // Check status format
                if (!preg_match("/^[a-zA-Z0-9,!?.]+(?: [a-zA-Z0-9,!?.]+)*$/", $status)) {
                    echo "<p>Your status is in a wrong format! The status can only contain alphanumericals, spaces, comma, period, exclamation point, and question mark.
                    <p><a href='poststatusform.php'>Post status page</a>
                    <p><a href='index.html'>Return to the Home page</a></p>";
                    exit;
                }

                // Validate date
                $dateObj = DateTime::createFromFormat('d/m/Y', $date);
                if (!$dateObj || $dateObj->format('d/m/Y') !== $date) 
                {
                    echo "<p>Invalid date format! Please enter a valid date.
                    <p><a href='poststatusform.php'>Post status page</a>
                    <p><a href='index.html'>Return to the Home page</a></p>";
                    exit;
                }

                // Insert status into the database
                $query = "INSERT INTO $table (stcode, st, share, date, permission) VALUES ('$status_code', '$status', '$share', '$date', '$permission')";
                $result2 = mysqli_query($conn, $query);
                if ($result && $result2) 
               {
                    echo "<p>Congratulations! The status has been posted! <p><a href='index.html'>Return to Home Page</a></p>";
                } 
                 else 
                {
                    echo "<p>Failed to post the status. Please try again later.</p>";
                }
            } 
            else 
             {
                echo "<p>In order to save the status to database, please make sure these fields need to be filled: Status Code, Status, Share, Date, Permission.</p>
                <p><a href='poststatusform.php'>Post status page</a>";
            }
        }
        // Close database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>