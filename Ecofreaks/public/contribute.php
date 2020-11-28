<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  

  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    
    $new_user = array(
      "names" => $_POST['names'],
      "gender"  => $_POST['gender'],
      "email"     => $_POST['email'],
      "dob"     => $_POST['dob'],
      "mobileno"       => $_POST['mobileno'],
      "location"  => $_POST['location'],
      "pincode"  => $_POST['pincode']
       
    );

    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "aqi",
      implode(", ", array_keys($new_user)),
      ":" . implode(", :", array_keys($new_user))
    );
    
    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

  <?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote><?php echo escape($_POST['names']); ?> submitted successfully</blockquote>
  <?php endif; ?>

  <h2></h2>

  <form method="post">
  <head>
        
        <style>
        body {
    background: -webkit-linear-gradient(#93B874, #C9DCB9); 
    background: -o-linear-gradient(#93B874, #C9DCB9); 
    background: -moz-linear-gradient(#93B874, #C9DCB9); 
    background: linear-gradient(#93B874, #C9DCB9); 
    background-color: #93B874; 
}
        </style>
        

        </head>

  <table cellpadding="2" width="40%" bgcolor="99FFFF" align="center" cellspacing="2">

<tr>
<td colspan=2>
<center><font size=4><b>FILL THIS FORM </b></font></center>
</td>
</tr>

<tr>
<td colspan=2>
<center><font size=4><b style='color:blue;'>please come back to this page after your video submission and submit this form</b></font></center>
</td>
</tr>
<td>
<body>
    <a href="https://drive.google.com/drive/folders/10faVexovPCIvkMlI_vt93CYIpLRSajeT?usp=sharing" class="button">please upload your video here</a>
  </body></td>
</tr>
<tr>
<td>Full Name</td>
<td><input type="text" name="names" id="textnames" size="30"></td>
</tr>

<tr>
<td>Gender</td>
<td><input type="radio" name="gender" value="m" size="10">Male
<input type="radio" name="gender" value="f" size="10">Female
<input type="radio" name="gender" value="o" size="10">Other</td>
</tr>


<tr>
<td>EmailId</td>
<td><input type="text" name="email" id="emailid" size="30"></td>
</tr>

<tr>
<td>DOB</td>
<td><input type="text" name="dob" id="dob" size="30" placeholder="ex dd-mm-year"></td>
</tr>

<tr>
<td>MobileNo</td>
<td><input type="text" name="mobileno" id="mobileno" size="30" ></td>
</tr>

<tr>
<td>Location</td>
<td><input type="text" name="location" id="location" size="30"></td>
</tr>



<tr>
<td>PinCode</td>
<td><input type="text" name="pincode" id="pincode" size="30"></td>
</tr>


</select></td>


</tr>
<tr>
<td><input type="reset"></td>
<td colspan="2"><input type="submit" name="submit" value="Submit" /></td>
</tr>
</table>
  </form>

  <a href="index.php">Go For Updation</a>

<?php require "templates/footer.php"; ?>
