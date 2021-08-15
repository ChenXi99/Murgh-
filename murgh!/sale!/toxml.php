<?php
require("config.php");

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

// Select all the rows in the table ・・本当に全て必要？
try{
  $sql = "select * from users where 1";
  $result = $pdo->query($sql);
  if($result->rowCount() > 0){
    header("Content-type: text/xml");
    // Start XML file, echo parent node
    echo "<?xml version='1.0' ?>";
    echo '<markers>';
    $ind=0;
    while($row = $result->fetch()){
      // Add to XML document node
      echo '<marker ';
      echo 'id="' . $row['id'] . '" ';
      echo 'type="' . $row['type'] . '" ';
      echo 'name="' . parseToXML($row['name']) . '" ';
      echo 'image="' . parseToXML($row['image']) . '" ';
      echo 'mobile="' . $row['mobile'] . '" ';
      echo 'location="' . parseToXML($row['location']) . '" ';
      echo 'lat="' . $row['lat'] . '" ';
      echo 'lng="' . $row['lng'] . '" ';
      echo '/>';
      $ind = $ind + 1;
    }
    // End XML file
      echo '</markers>';
  }
}
catch(PDOException $e){
  die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
?>