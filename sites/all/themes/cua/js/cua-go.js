$(document).ready(function(){
  $('.untag_user').click(function(){

  });
});

function makepassive_or_viewprofile(redirect_path, uid){
var redirect_path = '"'+redirect_path+'"';
var popupdiv = "<div class='untag_popup' style='display:none' onclick='close_msg()'></div><div class='makepassive_popup' style='display:none'><span onclick='close_msg()'>X</span><button class='yes_button' onclick='makepassive_process("+uid+")'>MARKÉR PILOT SOM PASSIV</button><button onclick='location.href="+redirect_path+"'>SE PROFIL</button><img src='/sites/all/themes/cua/images/load.gif' class='load_symbol' style='display:none; margin-top:10%'></div>";
  $('body').append(popupdiv);
  $(".untag_popup").fadeIn(600);
  $(".makepassive_popup").fadeIn(900);
}

function makeactive_or_viewprofile(redirect_path, uid){
var redirect_path = '"'+redirect_path+'"';
var popupdiv = "<div class='untag_popup' style='display:none' onclick='close_msg()'></div><div class='makepassive_popup' style='display:none'><span onclick='close_msg()'>X</span><button class='yes_button' onclick='makeactive_process("+uid+")'>MARKÉR PILOT SOM AKTIV</button><button onclick='location.href="+redirect_path+"'>SE PROFIL</button><img src='/sites/all/themes/cua/images/load.gif' class='load_symbol' style='display:none; margin-top:10%'></div>";
  $('body').append(popupdiv);
  $(".untag_popup").fadeIn(600);
  $(".makepassive_popup").fadeIn(900);
}

function makepassive_process(uid){
  $(".untag_popup_msg button").hide();
  $(".load_symbol").show();
  $.post(Drupal.settings.basePath + "cyklingudenalder/makepassive/"+uid, function(data){
    if(data = "success"){
      window.location.reload();
    }
  });
}

function makeactive_process(uid){
  $(".untag_popup_msg button").hide();
  $(".load_symbol").show();
  $.post(Drupal.settings.basePath + "cyklingudenalder/makeactive/"+uid, function(data){
    if(data = "success"){
      window.location.reload();
    }
  });
}

function untag_approved_pilot(locationid, uid){
var popupdiv = "<div class='untag_popup' style='display:none'></div><div class='untag_popup_msg' style='display:none'><p>Er du sikker på, at du vil fravælge denne lokation ?</p><button class='yes_button' onclick='untag_approved_pilot_process("+locationid+","+uid+")'>Ja</button><button onclick='close_msg()'>Fortryd</button><img src='/sites/all/themes/cua/images/load.gif' class='load_symbol' style='display:none; margin-top:10%'></div>";
  $('body').append(popupdiv);
  $(".untag_popup").fadeIn(600);
  $(".untag_popup_msg").fadeIn(900);

}
function untag_approved_pilot_process(locationid, uid){
  $(".untag_popup_msg button").hide();
  $(".load_symbol").show();
  $.post(Drupal.settings.basePath + "cyklingudenalder/untagpilot/"+locationid+"/"+uid, function(data){
    if(data = "success"){
      alert("Succesfuld venstre lokation");
      window.location.reload();
    }
  });
}

function close_msg(){
  $(".untag_popup").hide();
  $(".untag_popup_msg").hide();
  $(".makepassive_popup").hide();
}
