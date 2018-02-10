<?php
header('Access-Control-Allow-Origin: *');
$servername = "localhost";
$username = "osboxes";
$password = "";
$dbname = "caol";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "select cu.no_usuario, cu.co_usuario from cao_usuario as cu inner join permissao_sistema as ps on cu.co_usuario = ps.co_usuario where ps.co_sistema=1 and in_ativo='S' and co_tipo_usuario IN (0,1,2);";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $response = array();
    while($row = $result->fetch_assoc()) {
    	$response['text'][]=array_map("utf8_encode", $row)[no_usuario];
    	$response['value'][]=array_map("utf8_encode", $row)[co_usuario];
        //$response[] = $row['no_usuario']
    }
    echo json_encode($response);
} else {
    echo "0 results";
}
$conn->close();
?>