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
    var pourcentage = document.getElementById('pourcentage');
      if (montant.checked)
          {
          document.getElementById('INmontant').style.display='block';
          document.getElementById('INpourcentage').style.display='none';
          document.getElementById('INmontant').setAttribute('required','required');
          }
      
         else {
          document.getElementById('INmontant').style.display='none';
          document.getElementById('INpourcentage').style.display='block';
          document.getElementById('INpourcentage').setAttribute('required','required');
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
