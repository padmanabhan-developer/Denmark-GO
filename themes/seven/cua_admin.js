var $ = jQuery;
$(document).ready(function(){
  $('#edit-community-select').change(function(){
    $(".kommune_locations_caption").show();
    $(".savebutton_section").fadeIn(200);
    $(".list_section").hide();
    $(".location_section").fadeIn(200);
    $(".user_locations_caption").hide();

    var profile = $('#edit-profiletype').val();
    var kommune_id = $('#edit-community-select').val();
    var url = Drupal.settings.basePath+'getusersofkommune';
    $.post( url, { kid: kommune_id, profile: profile }, function( data ) {
      $( ".list_section" ).empty().append( data );
    } );
    $( ".location_section" ).hide();

    var location_list_url = Drupal.settings.basePath+'getlocations';
    $.post( location_list_url, { kid: kommune_id }, function( locdata ) {
      $( ".location_section" ).empty().append( locdata );
      $( ".location_section" ).fadeIn(300);
      $(".list_section").show();
    } );
  });
});

function close_alert(){
  $(".overlay").hide();
  $(".save_triggered").hide();
  $(".save_completed").hide();
}

function trigger_ajax_for_location(user_id, kid){
  $(".kommune_locations_caption").hide();
  $(".user_locations_caption").show();
  $('.selected_user').removeClass('selected_user');
  $("li[userid='"+ user_id +"']").addClass('selected_user');
  $( ".location_section" ).hide();
  var url = Drupal.settings.basePath+'getlocationsflaggedbyuser';
  $.post( url, { uid: user_id, kid: kid }, function( data ) {
    if(data != '' || data != undefined){
      var loc_data = JSON.parse(data);
      $(".location_section input[type='checkbox']").attr("checked", false);
      $.each(loc_data, function(loc_nid, loc_name){
        $(".location_section input[value='"+ loc_nid +"']").attr("checked",true);
      });
    }
  });
  $( ".location_section" ).fadeIn(100);
}

function trigger_save_locations(){
  var user_id = $(".selected_user").attr("userid");
  if(user_id == '' || user_id == undefined){
    alert("Select a User");
    return false;
  }
  // $(".overlay").show();
  // $(".save_triggered").show();
  var posturl = Drupal.settings.basePath+'saveuserlocations';
  /*
   * Forming the selected locations JSON
   */
  var listItems = $(".location_section input:checked");
  var loc_name = {}; // declaring an empty object

  listItems.each(function() {
    var loc_nid = $(this).val();
    loc_name[loc_nid] = $(this).attr('name');
  });
  var loc_data = JSON.stringify(loc_name);

  // performing the AJAX call to save locations
  $.post( posturl , {uid:user_id, location_data:loc_data} , function(data){
    if(data == 'completed'){
      // $(".save_triggered").hide();
      // $(".save_completed").show(200);
    }
  });
}
