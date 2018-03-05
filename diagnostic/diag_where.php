<?php
	function query_1($id, $valeur){
		$where = $id." = ".$valeur;
		return $where;
	}
	
	function query_2($date_diagnostic, $valeur){
		$where = $date_diagnostic." > ".$valeur;
		return $where;
	}
	
	function query_3($date_diagnostic, $valeur){
		$where = $date_diagnostic." < ".$valeur;
		return $where;
	}
?>