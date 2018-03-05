<HTML>
	<head>
		<META charset="utf8">
		<title>Notifications</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>
<?php 
//si l'utilisateur est identifié, il accède à ses notifications
if(isset($_SESSION['id_compte'])){
	//ajout de la barre de navigation en fonction du type de compte
	include('../general/switchbar.php');?>

	<h1>Notifications</h1>

	<div id="accordion">
		
	<?php
	require "../general/connexionPostgreSQL.class.php";
	$connex = new connexionPostgreSQL();

	//recuperation des notifications relatives au compte connecté
	$req_notifs="SELECT n.id_notification, n.date_notification, n.titre_notification, n.message FROM notification_compte nc  
				JOIN notification n ON nc.id_notification=n.id_notification
				WHERE id_compte=" . $_SESSION['id_compte'] .
					' ORDER BY date_notification ASC';
	$result = $connex->requete($req_notifs);

	while ($row=pg_fetch_array($result,null,PGSQL_NUM)) { ?>
		<div class="card">
			<div class="card-header" id="heading<?php echo $row[0]; ?>">
				<h5 class="mb-0">
					<button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $row[0]; ?>" aria-expanded="true" aria-controls="collapse<?php echo $row[0]; ?>">
						<?php echo $row[1] . ' ' . $row[2]; ?>
					</button>
				</h5>
			</div>
			<div id="collapse<?php echo $row[0]; ?>" class="collapse" aria-labelledby="heading<?php echo $row[0]; ?>" data-parent="#accordion">
				<div class="card-body">
					<?php echo $row[3]; ?>
				</div>
			</div>
		</div>

	<?php
	}
	$connex->fermer(); ?>
	
	</div> <!--fin de l'accordeon-->
	
<?php
}else{
	//si l'utilisateur n'est pas identifié
	include ('../general/unconnected.php');
} ?>

	<!--bootstrap-->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</HTML>
