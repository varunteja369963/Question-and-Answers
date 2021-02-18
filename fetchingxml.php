<?php
ini_set("display_errors", "0");
error_reporting(E_ALL);
$str = strtolower(urldecode($_REQUEST['q']));
$length = strlen($str);
$i = 1;
$xml_file = simplexml_load_file("subjectnamelist.xml") or die("Sorry for inconvenience. Try to select from checkboxes");
foreach ($xml_file->children() as $subjectname) {
    if ($subjectname == "") {
        continue;
    }   
    $name_to_echo = strtolower($subjectname);
    if (strpos($name_to_echo, $str) > 0) { 
        echo '<div class = "matched_tags" id = "'.$i.'">';
        echo "$subjectname";         
        echo '</div>';
        $i++;
    }
}
?>

