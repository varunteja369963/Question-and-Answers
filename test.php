<?php
$IP = $_SERVER['REMOTE_ADDR'];        // Obtains the IP address
$computerName = gethostbyaddr($IP); 
echo $IP;
echo "<br/>";

$ch = curl_init();

    $opt = curl_setopt($ch, CURLOPT_URL, "YOUR_SOME_URL_ADDRESS"); 

    curl_exec($ch);

    $response = curl_getinfo($ch);

    $result = array('client_public_address' => $response["primary_ip"],
                    'client_local_address' => $response["local_ip"]
            );

    var_dump($result);

    curl_close($ch);
?>