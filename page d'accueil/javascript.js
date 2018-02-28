function verif(){
            var log=document.getElementById('nom').value;
            var mdp=document.getElementById('mdp').value;
            $.ajax({
                type: 'post',
                url: 'page_verif.php',
                data : {
                    login : log,
                    mdp: mdp
                },
                success: function (response){
                    document.getElementById('alerte').innerHTML=response;
                },
    
            });  
        };