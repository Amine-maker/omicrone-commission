



<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="index.php?uc=commercial&action=afficherTableau" class="sidebarA">COMMERCIAL</a>
  <a href="index.php?uc=contrat&action=affichercontrat" class="sidebarA">CONTRAT</a> 
  <a href="index.php?uc=commission&action=afficherCommission" class="sidebarA">COMMISSIONS</a> 
  <a href="index.php?uc=client&action=afficherclient" class="sidebarA">CLIENTS</a>
  <a href="index.php?uc=depense&action=afficherDepense" class="sidebarA">DEPENSES</a> 
  
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
        
