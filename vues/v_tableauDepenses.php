

<div class="container">
  <ul class="responsive-table">
    <li class="table-header">
      <div class="col col-2">Id depense</div>
      <div class="col col-3">Libelle</div>
      <div class="col col-4">Montant</div>
    </li>
<?php

foreach ($lesDepenses as $uneDep){
    ?>
    
    <li class="table-row">
      <div class="col col-2" data-label="Id depense"><a class="tableau" href="index.php?uc=depense&action=modifierDepense&idDepense=<?php echo $depenseDao->getIdDepense($uneDep)?>">
        <i class="fas fa-edit"></i></a>
      <a class="delete" onclick=
      "if (confirm('voulez vous supprimer ?'))
      {window.location.replace('index.php?uc=depense&action=deleteDepense&idDepense=<?php echo $depenseDao->getIdDepense($uneDep)?>');}">
        <i class="fas fa-times"></i></a><?php echo $depenseDao->getIdDepense($uneDep)?></div>
      <div class="col col-3" data-label="Libelle"><?php echo $uneDep->getLibelle() ?> </div>
      <div class="col col-4" data-label="Montant"><?php echo $uneDep->getMontant() ?> €</div>
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
 a {
    background-color:#95A5A6;
    border: none;
    color: #FFFFFF;
    text-align: center;
    transition-duration: 0.4s;
    text-decoration: none;
    font-size: 16px;
    cursor: pointer;
    padding: 7px 6.5px;
    
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
  .container {
    max-width: 1000px;
    margin-left: auto;
    margin-right: auto;
    padding-left: 10px;
    padding-right: 10px;
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
  .responsive-table .col-2 {
    flex-basis: 40%;
  }
  .responsive-table .col-3 {
    flex-basis: 25%;
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

