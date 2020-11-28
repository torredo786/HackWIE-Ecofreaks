<?php

/**
 * List all users with a link to edit
 */

require "../config.php";
require "../common.php";

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM aqi ";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>
        
<h2>Update users</h2>

<table>
    <thead>
        <tr>
        <th>#</th>
        <th>Full Name</th>
        <th>Gender</th>
        <th>EmailId</th>
        <th>DOB</th>
        <th>MobileNo</th>
        <th>location</th>
        <th>Pincode</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
        <td><?php echo escape($row["names"]); ?></td>
        <td><?php echo escape($row["gender"]); ?></td>
        <td><?php echo escape($row["email"]); ?></td>
        <td><?php echo escape($row["dob"]); ?></td>
        <td><?php echo escape($row["mobileno"]); ?></td>
        <td><?php echo escape($row["location"]); ?></td>
        <td><?php echo escape($row["pincode"]); ?></td>
            <td><a href="update-single.php?mobileno=<?php echo escape($row["mobileno"]); ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>