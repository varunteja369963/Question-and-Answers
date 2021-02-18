<?php
include_once("connection.php");
$change_username = "SELECT `username`, `hashusername` FROM `userslist`";
$result_username = $conn->query($change_username);
$i = 1;
if ($result_username->num_rows > 0) {
    while ($row = $result_username->fetch_assoc()) {
        if (md5($row['username']) === $row['hashusername']) {
            echo $i . "is good";
            $i++;
            echo '<br>';
        }
        else {
          $alter = $conn->prepare("UPDATE `userslist` SET `hashusername` = ? WHERE `username` = ?");

          $alter->bind_param("ss", $hashusername, $row['username']);
          $hashusername = md5($row['username']);
          if ($alter->execute()) {
              echo $i . "is changed";
              $i++;
              echo '<br>';
          }
          $alter->close();

        }
    }
}

$conn->close();
?>
