<?
$url="http://localhost:59353/api/values/";

$ch=curl_init();

curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,4);

$json=curl_exec($ch);
if(!$json){
    echo curl_error($ch);
}
curl_close($ch);
// print_r($json);


// Get parameters from URL
//$center_lat = $_GET["lat"];
//$center_lng = $_GET["lng"];
//$radius = $_GET["radius"];
// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);
// Opens a connection to a mySQL server
/*$connection = mysql_connect("localhost", $username, $password);
if (!$connection) {
  die("Not connected : " . mysql_error());//
}
// Set the active mySQL database
    $db_selected = mysql_select_db($database, $connection);
    if (!$db_selected) {
    die ("Can\'t use db : " . mysql_error());
}
// Search the rows in the markers table
$query = sprintf("SELECT id, name, address, lat, lng, ( 3959 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
  mysql_real_escape_string($center_lat),
  mysql_real_escape_string($center_lng),
  mysql_real_escape_string($center_lat),
  mysql_real_escape_string($radius));
$result = mysql_query($query);
$result = mysql_query($query);
if (!$result) {
  die("Invalid query: " . mysql_error());
}
*/
header("Content-type: text/xml");
// Iterate through the rows, adding XML nodes for each
// while ($row = @mysql_fetch_assoc($result)){
foreach ($json)
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("PharmacyName", $json['PharmacyName']);
  $newnode->setAttribute("PharmacyType", $json['name']);
  $newnode->setAttribute("StreetAddressLine1", $json['address']);
  $newnode->setAttribute("StreetAddressLine2", $json['lat']);
  $newnode->setAttribute("City", $json['lng']);
  $newnode->setAttribute("State", $json['distance']);
  $newnode->setAttribute("Zip", $json['distance']);
  $newnode->setAttribute("AddressType", $json['distance']);
  $newnode->setAttribute("WebsiteURL", $json['distance']);
}
echo $dom->saveXML();
?>