<?php

/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  
  

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $user =[
      "names" => $_POST['names'],
      "gender"  => $_POST['gender'],
      "email"     => $_POST['email'],
      "dob"     => $_POST['dob'],
      "mobileno"       => $_POST['mobileno'],
      "location"  => $_POST['location'],
      "pincode"  => $_POST['pincode']
    ];

    $sql = "UPDATE aqi
            SET names = :names, 
              gender = :gender, 
              email = :email,
              dob = :dob,  
              mobileno = :mobileno,
              location=:location,
              pincode = :pincode
              

            WHERE mobileno = :mobileno";
  
  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
  
if (isset($_GET['mobileno'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $mobileno = $_GET['mobileno'];

    $sql = "SELECT * FROM aqi WHERE mobileno = :mobileno";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':mobileno', $mobileno);
    $statement->execute();
    
    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote><?php echo escape($_POST['names']); ?> successfully updated.</blockquote>
<?php endif; ?>

<h2>Edit a user</h2>

<form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <?php foreach ($user as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" mobileno="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'mobileno' ? 'readonly' : null); ?>>
    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
