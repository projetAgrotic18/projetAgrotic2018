function verif(){
    var log=document.getElementById('nom').value;
    var mdp=document.getElementById('mdp').value;
    $.ajax({
        type: 'POST',
        url: 'page_verif.php',
        timeout: 1000,
        data : {
            login : log,
            mdp: mdp
        },
        success: function (response){
            document.getElementById('form').submit();
        },
        error: function(){
            alert('erreur en ajax');
        }
    });  
}