<?php 
//switch the navbar depending on user account type
if($_SESSION['id_type_compte']==1){
	include('../Front/navigation_veto.html');
}elseif($_SESSION['id_type_compte']==2){
	include ('../Front/navigation_eleveur.html');
}elseif($_SESSION['id_type_compte']==3){
	include ('../Front/navigation_gds.html');
}elseif($_SESSION['id_type_compte']==4){
	include ('../Front/navigation_ddpp.html');
}elseif($_SESSION['id_type_compte']==5){
	include ('../Front/navigation_labo.html');
}elseif($_SESSION['id_type_compte']==6){
	include ('../Front/navigation_admin.html');
}
?>
