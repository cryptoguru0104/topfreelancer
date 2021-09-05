<?php 
// Include the database config file 
$servername = "localhost";
$username 	= "root";
$password 	= "";
$dbname 	= "topfreelancer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "cities.csv"; 
 
// Column names 
$fields = array('id', 'name', 'slug', 'country_id', 'state_id', 'status'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 


$sql 	= "SELECT rac_states.id, rac_states.country_id, rac_cities.* FROM rac_states LEFT JOIN rac_cities ON rac_states.id = rac_cities.state_id";

//$sql 	= "SELECT * FROM rac_states ORDER BY id ASC";

$result = $conn->query($sql);
// if ($result->num_rows > 0) {
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
// 	  var_dump($row);
//    // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
//   }
// } else {
//   echo "0 results";
// }
 
if($result->num_rows > 0){ 
    // Output each row of the data 
    $i=0; 
    while($row = $result->fetch_assoc()){ $i++; 
        $rowData = array($i, $row['name'], $row['slug'], $row['country_id'], $row['state_id'], $row['status']); 
        array_walk($rowData, 'filterData'); 
        $excelData .= implode("\t", array_values($rowData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
header("Content-Type: application/vnd.ms-excel"); 
 
// Render excel data 
echo $excelData; 
 
exit;
