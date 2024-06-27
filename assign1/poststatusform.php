<!DOCTYPE html>
<html xmlns = "http://www.w3.org/1999/xhtml" lang= "en" xml : lang="en" >
<head>
<meta http-equiv="content-type" content="text/html; charset = utf-8" />
<title>Post status form</title>
<link rel="stylesheet" href= "style.css"/>

</head>
<ul>
<body class ="bd2">
    <h1>Status Posting System</h1>
        <form action="poststatusprocess.php" method="post" id="fa">
           <label for="status_code">Status Code:</label>
             <input type="text" 
              id="status_code" 
              name="stcode" >
           
 
            <br><br>
          <label>Status:</label>
             <input type="text"
              name="st">


          <br><br>
          <label>Share:</label>
           <input type="radio" name="share" value="University">University

          <input type="radio" name="share" value="Class">Class

          <input type="radio" name="share" value="Private">Private


         <br><br>
          <label>Date:</label>
          <input type ="text"
                    name="date"
          value="<?php echo date('d/m/Y'); ?>"
          min ='<?php echo date('d/m/Y');?>' required>


         <br><br>
          <label>Permission:</label>
          <input type="checkbox" name="permission[]" value="Allow Like">Allow Like
       

          <input type="checkbox" name="permission[]" value="Allow Comments">Allow Comments
         

          <input type="checkbox" name="permission[]" value="Allow Share">Allow Share
          
          <br><br>
          <input type ="Submit" name="submit" id="submit">
          

         </form>  
         <p><a class="e" href="index.html">Return to Home Page</a>
       
     </body>
</ul>
</html>