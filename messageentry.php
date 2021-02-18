<html>
    <head>
</head>
<body>
        <?php
session_start(); 
$friendid = $_GET['id'];
   $friendname = $_GET['username'];
include_once('connection1.php');

  $createfriend = "CREATE TABLE IF NOT EXISTS $friendname(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    chat TEXT NOT NULL,
    place TINYINT(1) NOT NULL,
    sendedtime DATETIME NOT NULL
    )";
    $conn->query($createfriend);

$myid = $_SESSION['id'];
$myname = $_SESSION['username'];

mysqli_select_db($conn, 'membersinwebsite');
$select_fridb = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
$select_fridb->bind_param("s", $friendname);
$select_fridb->execute();
$result_fridb = $select_fridb->get_result();
$row_fridb = $result_fridb->fetch_assoc();
$created_db = $row_fridb['databasename'];
mysqli_free_result($result_fridb);
mysqli_select_db($conn, $created_db);



  $createfriend2 = "CREATE TABLE IF NOT EXISTS `$myname`(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    chat TEXT NOT NULL,
    place TINYINT(1) NOT NULL,
    sendedtime DATETIME NOT NULL
    )";
    if ($conn->query($createfriend2) == TRUE) { 
        header("location: message.php?id=".$friendid."&username=".$friendname);
    }
 
    $conn->close();
?>
</body>
</html>
