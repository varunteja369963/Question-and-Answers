<?php
session_start();
$friendname = $_REQUEST['friendname'];
include_once('connection1.php');

            $select = "SELECT * FROM $friendname";
            $result = $conn->query($select);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['place'] == 1) {
                        echo '<pre>';
                        echo '<p align = "right">';
                        echo $row['chat'];
                        echo '</p>';
                        echo '</pre>';
                    }
                    else {
                        echo "<p align = 'left'>";
                        echo $row['chat'];
                        echo '</p>';
                    }
                }
            }
            else {
                printf("You have no Conversation with him");
            }
    $conn->close();
?>