<?php 
$sqlsl = "SELECT image  FROM uimages WHERE  mem_id = '$mem_id'  AND image IS NOT NULL ";
$qsl = $conn->prepare($sqlsl);
$qsl->execute();
$countsl = $qsl->rowCount();


echo '<div id="slides">';
echo ' <div class="slides_container ">';

while($rowsl = $qsl->fetch()){
 echo               '<div >';
 echo '<img src="imagesmemorial/' .$rowsl['image'].' " class="imgshadow">';
  echo              '</div>';
     }           
  echo              '</div>';
  echo              '</div>';


//echo $countsl;
?>
