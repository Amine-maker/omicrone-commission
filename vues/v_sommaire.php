<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="index.php?uc=commercial&action=afficherTableau" class="sidebarA">Commerciaux</a>
  <a href="index.php?uc=contrat&action=affichercontrat" class="sidebarA">Contrats</a> 
  <a href="index.php?uc=commission&action=afficherCommission" class="sidebarA">Commissions</a> 
  <a href="index.php?uc=client&action=afficherclient" class="sidebarA">Clients</a>
  <a href="index.php?uc=depense&action=afficherDepense" class="sidebarA">D&eacute;penses</a>  
  <a href="index.php?uc=consultant&action=afficherConsultant" class="sidebarA">Consultants</a>
  <!-- <a href="index.php?uc=facture&action=choixFacture" class="sidebarA">Facture</a>  -->
  <a href="index.php?uc=cra&action=choisirCra" class="sidebarA">Generer un CRA</a> 
</div>

<div id="main">
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
</div>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "200px";
  document.getElementById("main").style.marginLeft = "200px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
        
