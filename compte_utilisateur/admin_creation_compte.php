<html>
	<head> 
		<!--By les Pokemen-->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js">
		</script>
	
		<script type="text/javascript">
		function type_form(str){
				$.ajax({
					type: 'get',
					url: 'admin_creation_compte2.php',
					data: {
						porygon:str
					},
					success: function (response) {
						document.getElementById("monFormulaire").innerHTML=response;
					}
				});
			}
		</script>
		
	</head>
	<body>
		Bienvenue dans l'assistance de création de compte. <br/>
		Que puis-je pour vous?<br/>
		<h2>Type de compte:</h2>
		
		<!-- Radio-boutonpour sélectionner le type de formulaire à remplir-->
		<center><form>
			<INPUT type = radio name = rb value = 'ddpp' onclick = type_form(this.value)>DDPP 
			<INPUT type = radio name = rb value = 'gds' onclick = type_form(this.value)>GDS 
			<INPUT type = radio name = rb value = 'veto' onclick = type_form(this.value)>Vétérinaire / GTV 
			<INPUT type = radio name = rb value = 'labo' onclick = type_form(this.value)>Laboratoire 
			<INPUT type = radio name = rb value = 'eleveur' onclick = type_form(this.value)>Eleveur <br/>
		</form></center>
		
		<!-- Affichage formulaire adapté-->
		<span id="monFormulaire"></id>
		
	</body>
</html>