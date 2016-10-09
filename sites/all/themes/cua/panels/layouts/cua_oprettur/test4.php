<?php
ini_set('display_errors', 0);
$id = intval($_GET["id"]);
$con=mysqli_connect("mysql14.unoeuro.com","gobooking_bike","t4bkrcwd","gobooking_bike_db2");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$num = 1;
$sql2 = "SELECT node.title AS node_title, node.nid AS nid, field_data_field_aktiv.field_aktiv_value FROM node LEFT JOIN field_data_field_aktiv ON node.nid = field_data_field_aktiv.entity_id AND field_data_field_aktiv.field_aktiv_value = '0' LEFT JOIN  field_data_field_testlokation ON node.nid = field_data_field_testlokation.entity_id AND (field_data_field_testlokation.entity_type = 'node' AND field_data_field_testlokation.deleted = '0') WHERE (( (field_data_field_testlokation.field_testlokation_target_id = '" . $id . "' ) )AND(( (node.status = '1') AND (node.type IN  ('beboer'))  )))";
// " . $id . "
$result2 = mysqli_query($con,$sql2);
while($row2 = mysqli_fetch_array($result2)) {
echo '<!--  tal:' . $num . '-->';
$num ++;
}
?>
<script type="text/javascript">
(function ($) {

function foohide() {
//$("ul.chosen-results li:nth-child(2)").css("display","none");
//clearInterval(interval2);
}
})(jQuery);
</script>
<?
mysqli_close($con);
?>
