<?php $module_path = drupal_get_path('module','cyklingudenalder'); ?>
<div class="main_wrapper">
  <div class="left_box">
    <div class="filter_section">
      <?php print render($form['community_select']); ?>
      <?php print render($form['profiletype']); ?>
    </div>
    <div class="list_section" style="display:none"></div>
  </div>
  <div class="right_box">
    <div class="savebutton_section" style="display:none">
      <span class="kommune_locations_caption" style="display:none">
        <?php echo t('Locations under Selected Municipality'); ?>
      </span>
      <span class="user_locations_caption" style="display:none">
        <?php echo t('Locations of Selected User'); ?>
      </span>
      <div class="button_savelocations" onclick="trigger_save_locations()">SAVE</div>
    </div>
    <div class="location_section" style="display:none"></div>
  </div>
  <div style="clear:both"></div>
</div>
<div class="overlay" style="display:none" onclick="close_alert()"></div>
<div class="save_completed" style="display:none" onclick="close_alert()">
<img src="/<?php echo $module_path ; ?>/done.gif">
</div>
