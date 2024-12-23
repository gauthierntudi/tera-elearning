<?php
	function get_formations(){
		global $bdd;
		$stmp = $bdd->query("SELECT id,title FROM Formations");
		$formations = $stmp->fetchAll(PDO::FETCH_ASSOC);

		return $formations;
	}

?>