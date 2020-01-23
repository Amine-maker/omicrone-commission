const buttons = document.querySelectorAll(`button[data-modal-trigger]`);

for(let button of buttons) {
	modalEvent(button);
}

function modalEvent(button) {
	button.addEventListener('click', () => {
		const trigger = button.getAttribute('data-modal-trigger');
		const modal = document.querySelector(`[data-modal=${trigger}]`);
		const contentWrapper = modal.querySelector('.content-wrapper');
		const close = modal.querySelector('.close');

		close.addEventListener('click', () => modal.classList.remove('open'));
		modal.addEventListener('click', () => modal.classList.remove('open'));
		contentWrapper.addEventListener('click', (e) => e.stopPropagation());

		modal.classList.toggle('open');
	});
}




function afficher(){
    var montant = document.getElementById('montant');
      if (montant.checked)
          {
          document.getElementById('INmontant').style.display='block';
          document.getElementById('INpourcentage').style.display='none';
          document.getElementById('INmontant').setAttribute('required','required');
          document.getElementById('INpourcentage').removeAttribute('required');
          }
      
         else {
          document.getElementById('INmontant').style.display='none';
          document.getElementById('INpourcentage').style.display='block';
          document.getElementById('INpourcentage').setAttribute('required','required');
          document.getElementById('INmontant').removeAttribute('required');
            }
          
        }

function afficherRib(){
    var str = document.forms['formC'].nom.value;
    var str2 = document.forms['formC'].prenom.value;
    var str3 = document.forms['formC'].tel.value;
        if (document.getElementById('voir').checked && str.replace(/\s+/, '').length && str2.replace(/\s+/, '').length && str3.replace(/\s+/, '').length)
            {
            document.getElementById('affichage').style.display='block';
            }
        else {
            document.getElementById('voir').checked=false;
            alert("veiller renseigner tous les champs avant d'ajouter un RIB");
            document.getElementById('affichage').style.display='none';
            
            }
            
        }


    
        function modif(monId,monName){
            
         var id=monId;
         var form = 'de'+id;
         var tdform = 'td'+id;
         var fas='de'+monName;
         var i=0;
         document.getElementsByName(form).forEach(()=>{
                document.getElementsByName(form)[i].style.display="";
                document.getElementsByName(form)[i].size=6;
                document.getElementsByName(id)[i].style.display="none";
                document.getElementsByName(tdform)[i].style.display="";
                document.getElementById(monName).style.display="none";
                document.getElementById(fas).style.display="";
                if(document.getElementsByName(form).value=="<i>Null</i>") {
                    document.getElementsByName(form).setAttribute("readonly","readonly");
                                                                         }
                                                                         
                        i++;
                        })
           }
   
        function submit(mon,idCommission,idCommercial){// commissions
        var arra=[];
        var id=mon;
        var form = 'de'+id;
            
            for(i=0;i<=1;i++)  { arra[i]=document.getElementsByName(form)[i].value;} 

            if(!document.getElementsByName(form)[1].hasAttribute("readonly")){

                  if(document.getElementsByName(form)[1].value<=100 && document.getElementsByName(form)[1].value>=0)
                  {
                     return(window.location.href="index.php?uc=commission&action=updateCommission&tableau="+arra+"&idCommission="+idCommission+"&idCommercial="+idCommercial);
                  }
                  else{alert('Le pourcentage ne peut dépasser 100% ou être nul ')}
          }
          else{return(window.location.href="index.php?uc=commission&action=updateCommission&tableau="+arra+"&idCommission="+idCommission+"&idCommercial="+idCommercial);}
        }
        
           function submitDepense(mon,idDepense){
            var arra=[];
            var id=mon;
            var form = 'de'+id;
            
            for(i=0;i<=1;i++)  { arra[i]=document.getElementsByName(form)[i].value;
            }     
                if(isNaN(arra[1])){
                    return(window.location.href="index.php?uc=depense&action=updateDepense&tableau="+arra+"&idDepense="+idDepense);
                }
                else{alert("Veuillez entrer un libelle")}
                 
           

           }

           function submitCommercial(mon,idCommercial){
            var arra=[];
            var id=mon;
            var form = 'de'+id;
            
            for(i=0;i<=6;i++)  { arra[i]=document.getElementsByName(form)[i].value; }     
                 
            if(isNaN(arra[0]) && isNaN(arra[1]) && isNaN(arra[3]) && isNaN(arra[4]) && isNaN(arra[5])){
                 return(window.location.href="index.php?uc=commercial&action=modifCommercial&tableau="+arra+"&idCommercial="+idCommercial);

           }
               else {alert("Veuillez entrer les champs correctement")}
          }

           function submitConsultant(mon,idConsultant){
            var arra=[];
            var id=mon;
            var form = 'de'+id;
            
            for(i=0;i<=6;i++)  { arra[i]=document.getElementsByName(form)[i].value; }  
            
            if(isNaN(arra[0]) && isNaN(arra[1]) && isNaN(arra[2]) && isNaN(arra[3]) && isNaN(arra[6])){
                return(window.location.href="index.php?uc=consultant&action=modifconsultant&tableau="+arra+"&idConsultant="+idConsultant);

          }
              else {alert(" Veuillez entrer les champs correctement")}
                 
           }

           function submitClient(mon,idClient){
            var arra=[];
            var id=mon;
            var form = 'de'+id;
            
            for(i=0;i<=10;i++)  { arra[i]=document.getElementsByName(form)[i].value; }     
                 
            if(isNaN(arra[0]) && isNaN(arra[1])==false && isNaN(arra[2]) && isNaN(arra[3]) && isNaN(arra[4])==false && isNaN(arra[5]) && isNaN(arra[8])==false && isNaN(arra[9])==false && isNaN(arra[10])==false){
                 return(window.location.href="index.php?uc=client&action=modifclient&tableau="+arra+"&idClient="+idClient);
           } else { alert("Veillez entrer les champs correctement")}
           


           }


