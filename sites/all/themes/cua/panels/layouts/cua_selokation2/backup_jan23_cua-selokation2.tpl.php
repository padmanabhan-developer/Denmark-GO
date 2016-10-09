<div class="lokationer_sub">

                                                                        
  <div class="breadcrumbs">
                             <ul>
                               <li><a href="/lokationer">TILBAGE</a></li>
                             </ul>
                        </div>
                        <?php print $content['mc5']; ?>
                       <div class="location-subpage-left">
                       <?php print $content['mc1']; ?>  
                        
                     <div class="row12">
                       <h4>LOKATIONENS <strong>CYKLER</strong></h4><?php print $content['mc7']; ?>
                       <ul><?php print $content['mc2']; ?></ul>
                         </div><!--close row12-->
                         
                         
                         <!-- <div class="row13" id="lok1">
                         	  <?php print $content['mc3']; ?>
                         	 </div>
                         
                         
                         <div class="row14">
                            <?php print $content['mc4']; ?>
                         </div>-->
                         </div><!--close location-subpage-left-->
                        
                        <div class="location-subpage-right">
               				 <div class="side1">
                            <ul>
                            <?php print $content['mc8']; ?>
                         <?php print $content['mc9']; ?>
                       <div class="clear"></div>
                         </ul>
                         
                                
                                 
<?php
$node = menu_get_object();
$nid = $node->nid;
 
if ($_GET["goduser"] == "ok") {
$auid = intval($_GET["auid"]);
$anode = node_load($nid);
$count = count($anode->field_godkendte_piloter['und']);
$anode->field_godkendte_piloter['und'][$count]['uid'] = $auid; 
node_save($anode);
global $user, $base_url;
$user_fields = user_load($auid);

$firstname = $user_fields->field_fornavn['und']['0']['value'];
		$lastname = $user_fields->field_efternavn['und']['0']['value'];
		$email = $user_fields->mail;
		$location_name = $anode->title;
		
		$mail_subject = "Du er nu godkendt som pilot på $location_name";

		$field_tovholders = $node->field_tovholder['und'];print_r($field_tovholders);
		$udata = $namestr =  $mailstr = $telstr = "";

		foreach ($field_tovholders as $indx => $userdata) {
			$udata = user_load($userdata['uid']);
			
			if ($namestr != "") {
			  $namestr .= ",".$udata->field_fornavn['und']['0']['value']." ".$udata->field_efternavn['und']['0']['value'];
			} else {
			  $namestr = $udata->field_fornavn['und']['0']['value']." ".$udata->field_efternavn['und']['0']['value'];	
			}
			
			if ($telstr != "") {
			  $telstr .= ",".$udata->field_mobilnummer['und']['0']['value'];
			} else {
			  $telstr .= $udata->field_mobilnummer['und']['0']['value'];
			}
			
			$mailstr = ($mailstr!=""?",".$udata->mail:$udata->mail);
		}
	
$mail_body = <<<EOD
Hej $firstname $lastname

Du er nu godkendt på lokationen $location_name.

Du kan nu komme i gang med at trampe i pedalerne ved at booke ture her:
$base_url/ture

Hvis du har spørgsmål, er du altid velkommen til at kontakte tovholderen:

Navn: $namestr

Email: $mailstr

Telefon: $telstr

God fornøjelse på cykelstien!
EOD;
		//echo $mail_subject.$mail_body;
	
		$to = $email;
		$subject = $mail_subject;
		$txt = $mail_body;
		$headers = "Content-Type: text/plain; charset=UTF-8\n";
		$headers .= "From: $user->mail" . "\r\n" .
		"CC: spsenthilcs@gmail.com";

		mail($to,$subject,$txt,$headers);



?>
<script type="text/javascript">
location.reload();
</script>
<?
} 
 
 
 
 
 global $user;
 
if (in_array('aktivitetsmedarbejder', $user->roles)) {
$taluid = "";
$view = views_get_view('sendtogodkendtbruger');
$view->set_display('default');
$view->pre_execute();
$view->execute('default');
foreach ($view->result as $result) {
$taluid .= $result->uid . ",";
}
?>
<!--<a href="/messages/new/<? print $taluid ?>" class="contact-button">KONTAKT ALLE</a>-->
<?
}
?>
                                <!--  # -->
                             </div><!--close side1-->
                                 <h4><strong>GODKENDTE</strong> PILOTER</h4>
                             <div class="side1" ondrop="drop3(event)" ondragover="allowDrop3(event)">
                             	  <div class="thumb-box" >
                                  	   <?php print $content['mc10']; ?> 
                                  </div>
                             </div><!--close side1-->
                             <h4>PILOTER TIL <strong>GODKENDELSE</strong></h4>
                             <div class="side1" ondrop="drop2(event)" ondragover="allowDrop2(event)">
                             	  <div class="thumb-box" >
                                  	   <?php print $content['mc11']; ?>
                                  </div>
                             </div><!--close side1-->
                             
                             <h4>PILOTER TIL <strong>OPLÆRING</strong></h4>
                             <div class="side1" ondrop="drop(event)" ondragover="allowDrop(event)">
                             	  <div class="thumb-box" >
                                  	   <?php print $content['mc12']; ?>
                                  </div>
                             </div><!--close side1-->
                             
<?php print $content['mc6']; ?>
                        
  </div><!--close location-subpage-right-->                       
                        
               </div><!--close lokationer_sub-->
               <div id="oksyvtid"></div>
   
 <script type="text/javascript">
  
//document.getElementById('edit-title').value = 'Tur';


function allowDrop(ev) {
    ev.preventDefault();
}

function allowDrop2(ev) {
    ev.preventDefault();
}

function allowDrop3(ev) {
    ev.preventDefault();
}


function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drag2(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drag3(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
//alert(ev.dataTransfer.getData("text").replace("usr_",""));
 
location.reload();
}
   
   function drop2(ev) {
    ev.preventDefault();
    var dataus = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(dataus));
var usdata = ev.dataTransfer.getData("text").replace("usr_","");
$.get("http://loop.cyklingudenalder.dk/users/" + usdata + "?intro=ok" + "&rnd=" + Math.random() , function(data) {
 $("#oksyvtid").html(data);
     
 });
location.reload();
}
   
 function drop3(ev) {
    ev.preventDefault();
    var dataus = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(dataus));
var usdata = ev.dataTransfer.getData("text").replace("usr_","");
$.get(window.location.href + "?goduser=ok" + "&auid=" + usdata + "&nid=<? print $nid; ?>" + "&rnd=" + Math.random() , function(data) {
 $("#oksyvtid").html(data);
     
 });
location.reload();
}
        
        
    (function ($) {
    
    
    $('#edit-comment-body-und-0-value').appendTo('#lok1');
     $('#edit-submit').appendTo('#lok1');
  $("#edit-submit").addClass('submit2');
    $("#edit-comment-body-und-0-value").addClass('textarea8');
  $("#edit-comment-body-und-0-value").attr("placeholder", "SKRIV EN  KOMMENTAR...");
    })(jQuery);
    
    
//    $(function() {
//       
 //   });
</script>                             
<style>

#oksyvtid {
display:none;  
}

#comment-form {
display:none;  
}

<?php
global $user;
$uname = $user->name;
if ($uname != "kbh") {
?>
.location-subpage-right {
/*display:none;     */ 
}
<?
}
?>


</style>                      
