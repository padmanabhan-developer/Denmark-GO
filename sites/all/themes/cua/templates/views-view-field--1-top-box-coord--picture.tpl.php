<?php
$uid = $row->_field_data[users_field_data_field_godkendte_piloter_uid][entity]->uid;
$fname = $row->_field_data[users_field_data_field_godkendte_piloter_uid][entity]->field_fornavn[und][0][value];
$lname = $row->_field_data[users_field_data_field_godkendte_piloter_uid][entity]->field_efternavn[und][0][value];
$name = $row->_field_data[users_field_data_field_godkendte_piloter_uid][entity]->name;
$name = str_replace(' ', '-', $name);
$name = str_replace('_','',str_replace('.','',$name));
$img_file = $row->_field_data[users_field_data_field_godkendte_piloter_uid][entity]->picture->uri;

if(file_exists($img_file)){
  $img_src = file_create_url($img_file);
/*  if(!file_exists($img_src)){
    $img_src="/sites/all/themes/cua/images/Profile_Dummy.png";
  }*/
}
else{
  $img_src="/sites/all/themes/cua/images/Profile_Dummy.png";
}
$profile_path = "/users/".$name;
?>
<div class="ppl_image" title="<?php echo $fname ;?> <?php echo $lname ;?>" onclick="makepassive_or_viewprofile('<?php echo $profile_path ;?>', <?php echo $uid ;?>)" style="cursor:pointer">
<img title="<?php echo $fname ;?> <?php echo $lname ;?>" src="<?php echo $img_src ;?>" width="60" height="60" alt="<?php echo $fname ;?> <?php echo $lname ;?>" title="<?php echo $fname ;?> <?php echo $lname ;?>">
<p class="peoplebox_name">
<?php echo $fname ;?> <?php echo $lname ;?>
</p>
</div>
