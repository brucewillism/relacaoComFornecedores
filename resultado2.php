<?php
require("conect.php");

$id= $_GET["id"];

function parseToXML($htmlStr){
  $xmlStr=str_replace('<','&lt;',$htmlStr);
  $xmlStr=str_replace('>','&gt;',$xmlStr);
  $xmlStr=str_replace('"','&quot;',$xmlStr);
  $xmlStr=str_replace("'",'&#39;',$xmlStr);
  $xmlStr=str_replace("&",'&amp;',$xmlStr);
  return $xmlStr;
}

// Select all the rows in the markers table
$result_markers = "SELECT * FROM usuarios where USER_ID = '$id'";
$resultado_markers = mysqli_query($conn, $result_markers);

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row_markers = mysqli_fetch_assoc($resultado_markers)){
  // Add to XML document node
  echo '<marker ';
  echo 'name="' . parseToXML($row_markers['USER_EMPRESA']) . '" ';
  echo 'address="' . parseToXML($row_markers['USER_LOGRADOURO']) . '" ';
  echo 'lat="' . $row_markers['USER_LATITUDE'] . '" ';
  echo 'type="' . $row_markers['USER_TELEFONE'] . '" ';
  echo 'lng="' . $row_markers['USER_LONGITUDE'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';