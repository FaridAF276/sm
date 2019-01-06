
//Script file :
document.getElementById("addBtn").addEventListener("click", addrow);
document.getElementById("valbtn").addEventListener("click", valid);
    // document.getElementsByClassName("del_Btn").addEventListener("click", delrow);
    var i=0;
    function addrow()
    {
        var tb = document.getElementById("tbClientEntry");
        var tr = document.getElementById("seanceChamp");
        var newtr= tb.insertRow();
        var idx = newtr.rowIndex;
        newtr.innerHTML= tr.innerHTML;
        i++;
        newtr.id=tr.id+'_'+i;
        newtr.children[newtr.children.length -1].children.item(0).id="del_button_"+i;
    }
    function delrow(trg){
        //fonction appellée par les boutons supprimer
        document.getElementById("tbClientEntry").deleteRow(trg.parentElement.parentElement.rowIndex);
        //On prend l'arrière grand parent du bouton supprimer (le balise tr) on récpère son index et on supprime la ligne de cet index
    }
    function gettodaydate()
    {
        var today = new Date();
        var day = today.getDate();
        var month = today.getMonth()+1;//janvier est le mois 0
        var year = today.getFullYear();
        var hour = today.getHours();
        if (day<10) {
            day='0'+day;
        }
        if (month<10) {
            month='0'+month;
        }
        today = year + month + day + hour;
        var numfact = parseInt(today); //ransforme la date en int
        return numfact;
    }

    function valid() { 
        //Dès qu'on valide on crée directement un numbéro de facture.
        //Le client veut un numéro de facture qui contient la date d'ajd + deux chiffre
        //Date d'ajd
        var numfact = gettodaydate();
        var client = document.getElementById("select_client").value;
        var id = document.getElementById("select_client").getAttribute('name');
        alert("Clicked");
        // var idclient = document.getElementById("select_client")
        var tb = document.getElementById("tbClientEntry");;
        // var clientetfacture = 'cmd='+false+'&client='+client+'&facture='+numfact;
        //On va faire une requête HTML pour récupérer les ID.
        var dataenvoi = 'client='+client+'&numfact='+numfact+'&option= 1';
        $.ajax({
                    type : "POST",
                    url : "./includes/config/insertdataform.php",
                    data : dataenvoi,
                    cache : false
                });
        for (let index = 0; index < tb.rows.length; index++) {
            var comd=[];
            // const element = array[index];
            var trow=tb.rows.item(index);//retourn une ligne du tableau
            var td= trow.children; //retourne un tableau de <td>
            for (let tdindex = 0; tdindex < td.length-1; tdindex++) {
                if (td[tdindex].children[0].value!=null) {
                    comd.push(td[tdindex].children[0].value);
                }
                //Envoyez dans un autre fichier
            }
            var dataString = 'seance='+comd[0]+'&hdeb='+comd[1]+'&hfin='+comd[2]+'&datecmd='+comd[3] +'&client='+client+'&numfact='+numfact+'&option=2';
                $.ajax({
                    type : "POST",
                    url : "./includes/config/insertdataform.php",
                    data : dataString,
                    cache : false
                });
        }
        windows.location="www.google.com";
    }