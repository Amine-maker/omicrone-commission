

<div class="container">
  <ul class="responsive-table">
    <li class="table-header">
      <div class="col col-6">Id Commercial</div>
      <div class="col col-5">Nom</div>
      <div class="col col-5">Prenom</div>
      <div class="col col-5">Tel</div>
      <div class="col col-5">Email</div>
      <div class="col col-5">Adresse</div>
      <div class="col col-5">Ville</div>
      <div class="col col-5">Code Postale</div>
      <!-- <div class="col col-2">code agence</div>
      <div class="col col-2">num compte</div>
      <div class="col col-2">iban</div>
      <div class="col col-2">bic</div>
      <div class="col col-2">code banque</div>
      <div class="col col-2">cle rib</div>  -->
    </li>
<?php


//var_dump($lesFinance);

foreach ($lesFinance as $uneFinance){
    
    ?>

<li class="table-row">
<div class="col col-6" data-label="Id commercial"><a class="tableau" href="index.php?uc=commercial&action=modifCommercial&idCommercial=<?php echo $commerciauxDao->getIdCommercial($uneFinance->getOCommercial()) ?>">
  <i class="fas fa-edit"></i></a>
  <a class="delete" onclick=
      "if (confirm('voulez vous supprimer ?'))
      {window.location.replace('index.php?uc=commercial&action=deleteCommercial&idCommercial=<?php echo $commerciauxDao->getIdCommercial($uneFinance->getOCommercial())?>');}">
  <i class="fas fa-times"></i></a><?php echo $commerciauxDao->getIdCommercial($uneFinance->getOCommercial())?></div>
<div class="col col-5" data-label="Nom"><?php echo $uneFinance->getOCommercial()->getNom() ?></div>
<div class="col col-5" data-label="Prenom"><?php echo $uneFinance->getOCommercial()->getPrenom() ?></div>
<div class="col col-5" data-label="Tel"><?php echo $uneFinance->getOCommercial()->getTel() ?></div>
<div class="col col-5" data-label="Email"><?php echo $uneFinance->getOCommercial()->getEmail() ?></div>
<div class="col col-5" data-label="Adresse"><?php echo $uneFinance->getOCommercial()->getAdresse() ?></div>
<div class="col col-5" data-label="Ville"><?php echo $uneFinance->getOCommercial()->getVille() ?></div>
<div class="col col-5" data-label="Code Postale"><?php echo $uneFinance->getOCommercial()->getCp() ?></div>
<!-- <div class="col col-2" data-label=""><?php echo $uneFinance->getCodeAgence() ?></div>
<div class="col col-2" data-label=""><?php echo $uneFinance->getCompte() ?></div>
<div class="col col-2" data-label=""><?php echo $uneFinance->getIban()?></div>
<div class="col col-2" data-label=""><?php echo $uneFinance->getBic() ?></div>
<div class="col col-2" data-label=""><?php echo $uneFinance->getCodeBanque() ?></div>
<div class="col col-2" data-label=""><?php echo $uneFinance->getCleRib() ?></div> -->
</li>
<?php

}
?>
</ul>
</div>






<style> 
  
  body {
  font-family: 'lato', sans-serif;
  background-color: #efefef;
}
  .container {
    max-width: 1000px;
    margin-left: auto;
    margin-right: auto;
    padding-left: 10px;
    padding-right: 10px;
  }
  a {
    background-color:#95A5A6;
    border: none;
    color: #FFFFFF;
    padding: 7px 6.5px;
    text-align: center;
    transition-duration: 0.4s;
    text-decoration: none;
    font-size: 16px;
    cursor: pointer;
    
}
a.delete{
  border-radius: 25px;
  margin-right: 12px;
  background-color:red;
  padding-left: 10px;
  padding-right: 10px;
}
.delete:hover,.delete:active{
background-color: rgb(0, 0, 0);
}
a.tableau{

  border-radius: 20px;
  margin-right: 12px;
  background-color:#3c96ec;
  padding-left: 8px;
}
.tableau:hover,.tableau:active{
  background-color: rgb(0, 0, 0);
}
a:hover, a:active {
    background-color: rgb(0, 0, 0);
} 
  h2 {
    font-size: 26px;
    margin: 20px 0;
    text-align: center;
  }
  h2 small {
    font-size: 0.5em;
  }
  
  .responsive-table li {
    border-radius: 3px;
    padding: 25px 30px;
    display: flex;
    justify-content: space-between;
    margin-bottom: 25px;
  }
  .responsive-table .table-header {
    background-color: #95A5A6;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
  }
  .responsive-table .table-row {
    background-color: #ffffff;
    box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.1);
  }
  .responsive-table .col-1 {
    flex-basis: 10%;
  }
  .responsive-table .col-5 {
    flex-basis: 35%;

  }
  .responsive-table .col-6 {
    flex-basis: 50%;
  
  }
  .responsive-table .col-4 {
    flex-basis: 25%;
  }
  @media all and (max-width: 767px) {
    .responsive-table .table-header {
      display: none;
    }
    .responsive-table li {
      display: block;
    }
    .responsive-table .col {
      flex-basis: 100%;
    }
    .responsive-table .col {
      display: flex;
      padding: 10px 0;
    }
    .responsive-table .col:before {
      color: #6C7A89;
      padding-right: 10px;
      content: attr(data-label);
      flex-basis: 50%;
      text-align: right;
    }
  }
  </style>


