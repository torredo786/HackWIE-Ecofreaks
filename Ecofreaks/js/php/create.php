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
      "id"  => $_POST['id'],
      "gender"  => $_POST['gender'],
      "pincode"  => $_POST['pincode'],
      "email"     => $_POST['email'],
      "mobileno"       => $_POST['mobileno'],
      "salary"  => $_POST['salary']
    );

    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "SMS",
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
    <blockquote><?php echo escape($_POST['names']); ?> successfully added.</blockquote>
  <?php endif; ?>

  <h2></h2>

  <form method="post">
  <table cellpadding="2" width="50%" bgcolor="99FFFF" align="center" cellspacing="2">

<tr>
<td colspan=2>
<center><font size=4><b>SALARY MANAGEMENT SYSTEM</b></font></center>
</td>
</tr>

<tr>
<td>Employee Name</td>
<td><input type="text" name="names" id="textnames" size="30"></td>
</tr>

<tr>
<td>Employee Id</td>
<td><input type="text" name="id" id="id_no"
size="30"></td>
</tr>
<tr>
<td>Designation</td>
<td><select name="Designation">
<option value="-1" selected>select..</option>
<option value="manager">MANAGER</option>
<option value="accountant">ACCOUNTANT</option>
<option value="pur_manager">PURCHASING MANAGER</option>
<option value="it_officer">IT OFFICER</option>
<option value="oth">OTHER</option>
</select></td>
</tr>.

<tr>
<td>Gender</td>
<td><input type="radio" name="gender" value="m" size="10">Male
<input type="radio" name="gender" value="f" size="10">Female
<input type="radio" name="gender" value="o" size="10">Other</td>
</tr>

<tr>
<td>City</td>
<td><select name="City">
<option value="-1" selected>select..</option>
<option value="New Delhi">NEW DELHI</option>
<option value="Mumbai">MUMBAI</option>
<option value="Goa">GOA</option>
<option value="Patna">PATNA</option>
</select></td>
</tr>


<tr>
<td>PinCode</td>
<td><input type="text" name="pincode" id="pincode" size="30"></td>

</tr>
<tr>
<td>EmailId</td>
<td><input type="text" name="email" id="emailid" size="30"></td>
</tr>

<tr>
<td>DOB</td>
<td><input type="text" name="dob" id="dob" size="30"></td>
</tr>

<tr>
<td>MobileNo</td>
<td><input type="text" name="mobileno" id="mobileno" size="30"></td>
</tr>
<tr>
<td>Basic Salary</td>
<td><input type="text" name="salary" id="basic salary" size="30"></td>
</tr>
<tr>
<td></td>
<td><select name="benefits">
<option value="-1" selected>benefits..</option>
<option value="dbonus">Diwali Bonus</option>
<option value="cbonus">Christmas Bonus</option>
<option value="obonus">Overtime Bonus</option>
<option value="mbonus">Monthly Bonus</option>
   
<input type="checkbox" name="bonus" value="bonus_med">
<label for="bonus"> medical benefits 7%</label><br>
<input type="checkbox" name="bonus" value="bonus_hous">
<label for="bonus"> housing allowance 35%</label><br>
<input type="checkbox" name="bonus" value="bonus_trans">
<label for="bonus"> transport allowance 9%</label><br>
<input type="checkbox" name="bonus" value="other">
<label for="bonus"> other benefits </label><br>
</tr>
<tr>
<td>Grosspay</td>
<td><input type="lebel" name="gp" id="gross_pay" size="15"></td>
</tr>

<tr>
<td>Tax</td>
<td><input type="lebel" name="tax" id="tax_" size="15"></td>
</tr>

<td colspan="2"><input type="submit" value="compute" /></td>
</tr>
</select></td>


<tr>
<td>netpay</td>
<td><input type="lebel" name="netpay" id="netpay" size="15"></td>
</tr>


</tr>.
<tr>
<td><input type="reset"></td>
<td colspan="2"><input type="submit" name="submit" value="Submit" /></td>
</tr>
</table>
  </form>

  <a href="index.php">Go for updation</a>

<?php require "templates/footer.php"; ?>
