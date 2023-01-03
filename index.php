<?php
require 'phpQuery.php';
include_once 'function.php';
$ch = curl_init('https://detali.org.ua/ru/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);




$output = curl_exec($ch);
$doc= phpQuery::newDocument($output);
$menu=$doc->find('.cbp-hrmenu-tab li a');
foreach ($menu as $key=>$value) {
$pq = pq($value);
$href= $pq->attr('href');
$links[] = $href; 
}

$servername = "localhost";
$database = "detali";
$username = "root";
$password = "";
// Создаем соединение
$conn = mysqli_connect($servername, $username, $password, $database);

// Проверяем соединение
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully". "<br>";


foreach ($links as $link) { 
    echo $link. '<br>';
    $query = "INSERT INTO links (id, menulinks) VALUES (NULL, '$link')";
    $result = mysqli_query($conn, $query);
}

// if (mysqli_num_rows($result) > 0) {
//     // output data of each row
//     while($row = mysqli_fetch_assoc($result)) {
//         echo $row["menulinks"]. "<br>";
//     }
// } else {
//     echo "0 results";
// }

mysqli_close($conn);















