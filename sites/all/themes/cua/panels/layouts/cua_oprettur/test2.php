<?php
ini_set('display_errors', 0);
$id = intval($_GET["id"]);
$da = $_GET["da"];
$t1 = $_GET["t1"];
$t2 = $_GET["t2"];
$con=mysqli_connect("mysql14.unoeuro.com","gobooking_bike","t4bkrcwd","gobooking_bike_db2");
if (mysqli_connect_errno()) {
echo '<!--  SQL ERROR -->';
?>
<script type="text/javascript">
(function ($) {
$("#edit-submit4").attr('disabled','disabled');
$("#edit-submit4").css("background-color","#F38383");
$("#kanikkebookes").css("display","block");

 bookok = 0;
          })(jQuery);

</script>
<?
}

// ANTAL CYKLER
$sql3 = "SELECT COUNT(*) as antal FROM node INNER JOIN field_data_field_cykel_aktiv ON node.nid = field_data_field_cykel_aktiv.entity_id AND (field_data_field_cykel_aktiv.entity_type = 'node' AND field_data_field_cykel_aktiv.deleted = '0') LEFT JOIN  field_data_field_cykel_lokation ON node.nid = field_data_field_cykel_lokation.entity_id AND (field_data_field_cykel_lokation.entity_type = 'node' AND field_data_field_cykel_lokation.deleted = '0') LEFT JOIN field_data_field_cykel_brugstidspunkt ON node.nid = field_data_field_cykel_brugstidspunkt.entity_id AND (field_data_field_cykel_brugstidspunkt.entity_type = 'node' AND field_data_field_cykel_brugstidspunkt.deleted = '0') WHERE (( (field_data_field_cykel_lokation.field_cykel_lokation_nid = '" . $id . "' ) )AND(( (node.status = '1') AND (field_data_field_cykel_aktiv.field_cykel_aktiv_value = '1') ))) ";
$result3 = mysqli_query($con,$sql3);
while($row3 = mysqli_fetch_array($result3)) {
$antal = $row3['antal'];
}

$date = DateTime::createFromFormat('d/m/Y', $da);
$datestring = $date->format('Y-m-d');

$date1new = strtotime($datestring . ' ' . $t1 . ':00' );
$date2new = strtotime($datestring . ' ' . $t2 . ':00' );
$num = 0;
$sql2 = "SELECT node.nid AS nid, FROM_UNIXTIME(field_data_field_tur_dato.field_tur_dato_value) AS dato1, field_data_field_tur_dato.field_tur_dato_value as datonr1, FROM_UNIXTIME(field_data_field_tur_dato.field_tur_dato_value2) AS dato2, field_data_field_tur_dato.field_tur_dato_value2 as datonr2 FROM node LEFT JOIN field_data_field_testlokation ON node.nid = field_data_field_testlokation.entity_id AND (field_data_field_testlokation.entity_type = 'node' AND field_data_field_testlokation.deleted = '0') LEFT JOIN  field_data_field_tur_dato ON node.nid = field_data_field_tur_dato.entity_id AND (field_data_field_tur_dato.entity_type = 'node' AND field_data_field_tur_dato.deleted = '0') WHERE (( (node.status = '1') AND (node.type IN  ('tur')) AND (field_data_field_testlokation.field_testlokation_target_id = '" . $id . "') AND (field_data_field_tur_dato.field_tur_dato_value <= " . $date2new . " AND field_data_field_tur_dato.field_tur_dato_value2 >= " . $date1new . " ) ))";

$result2 = mysqli_query($con,$sql2);
while($row2 = mysqli_fetch_array($result2)) {
$num ++;
}

echo '<!--  num:' . $num . '-->';
echo '<!--  antal:' . $antal . '-->';

if ($antal == 1) {
if ($num == 0) {
?>

 <script type="text/javascript">
(function ($) {
$("#edit-submit4").removeAttr('disabled');
$("#edit-submit4").css("background-color","#489e5c");
$("#kanikkebookes").css("display","none");
bookok = 1;
          })(jQuery);

</script>
<?
}
  }

if ($antal > 1) {
if ($antal > $num) {
?>
<script type="text/javascript">
(function ($) {
$("#edit-submit4").removeAttr('disabled');
$("#edit-submit4").css("background-color","#489e5c");
$("#kanikkebookes").css("display","none");
bookok = 1;
          })(jQuery);

</script>
<?
}
}
mysqli_close($con);
?>
