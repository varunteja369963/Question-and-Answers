<?php   
include_once('connection.php');
date_default_timezone_set('Asia/Kolkata');   
$username_in_link = $_REQUEST['username'];
    $key = $_REQUEST['key'];
    $confirmcode = $_REQUEST['verificationcode'];
    if ($username_in_link == "" || $key == "" || $confirmcode == "") {      
    header('location: errorpage.html');
    echo '1';
    die();            
        }
        if ($key !== md5($username_in_link)) {
            header('location: errorpage.html');
            echo '1';
            die();
        }

        $select_confirm = "SELECT `id`, `sentdate` FROM `resetpassword`";
        $result_confirm = mysqli_query($conn,$select_confirm); 
        if ($result_confirm->num_rows > 0) { 
        while ($row_confirm = $result_confirm->fetch_assoc()) { 
            $id = $row_confirm['id'];
            $present_time = strtotime(date("Y/m/d h:i:s"));
            $exceed_time = strtotime($row_confirm['sentdate'])+3600;
            if ($present_time >= $exceed_time) {
                $delete = "DELETE FROM `resetpassword` WHERE id = '$id'";
        $conn->query($delete);
            }
        }
          }
        mysqli_free_result($result_confirm);

        $select_user = $conn->prepare("SELECT `username` FROM `resetpassword` WHERE `username` = ? AND `confirmationcode` = ?");
        $select_user->bind_param("ss", $username_in_link, $confirmcode);
        $select_user->execute();
        $result_user = $select_user->get_result();
      if ($result_user->num_rows > 0) {
          echo '2';
      }
      else {
          echo '1';
      }
$conn->close();
?>