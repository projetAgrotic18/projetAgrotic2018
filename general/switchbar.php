<?php 
//switch the navbar depending on user account type
if($_SESSION['id_type_compte']==1){
	include('../front/navigation_veto.html')
}elseif($_SESSION['id_type_compte']==2){
	include ('../front/navigation_eleveur.html')
}elseif($_SESSION['id_type_compte']==3){
	include ('../front/navigation_gds.html')
}elseif($_SESSION['id_type_compte']==4){
	include ('../front/navigation_gds.html')
}elseif($_SESSION['id_type_compte']==5){
	include ('../front/navigation_labo.html')
}elseif($_SESSION['id_type_compte']==6){
	include ('../front/navigation_admin.html')
}
?>
