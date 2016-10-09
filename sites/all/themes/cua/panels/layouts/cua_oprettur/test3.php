<?php
ini_set('display_errors', 0);
$id = intval($_GET["id"]);
$da = $_GET["da"];
$t1 = $_GET["t1"];
$t2 = $_GET["t2"];
$con=mysqli_connect("mysql14.unoeuro.com","gobooking_bike","t4bkrcwd","gobooking_bike_db2");
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$date = DateTime::createFromFormat('d/m/Y', $da);
$datestring = $date->format('Y-m-d');
$date1new = strtotime($datestring . ' ' . $t1 . ':00' );
$date2new = strtotime($datestring . ' ' . $t2 . ':00' );
//echo '<!--  tid:' . $date1new . '-->';
$num = 0;
$sql2 = "SELECT node.nid AS nid, FROM_UNIXTIME(field_data_field_tur_dato.field_tur_dato_value) AS dato1, field_data_field_tur_dato.field_tur_dato_value as datonr1, FROM_UNIXTIME(field_data_field_tur_dato.field_tur_dato_value2) AS dato2, field_data_field_tur_dato.field_tur_dato_value2 as datonr2 FROM node LEFT JOIN field_data_field_testlokation ON node.nid = field_data_field_testlokation.entity_id AND (field_data_field_testlokation.entity_type = 'node' AND field_data_field_testlokation.deleted = '0') LEFT JOIN  field_data_field_tur_dato ON node.nid = field_data_field_tur_dato.entity_id AND (field_data_field_tur_dato.entity_type = 'node' AND field_data_field_tur_dato.deleted = '0') WHERE (( (node.status = '1') AND (node.type IN  ('tur')) AND (field_data_field_testlokation.field_testlokation_target_id = '" . $id . "') AND (field_data_field_tur_dato.field_tur_dato_value BETWEEN " . $date1new . " AND " . $date2new . " ) ))";
$result2 = mysqli_query($con,$sql2);
while($row2 = mysqli_fetch_array($result2)) {
$num ++;
}
if ($num == 0) {
?>
OK
<?
} else {
?>
OK
<?
}
mysqli_close($con);
?>
