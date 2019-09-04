<?php
header('Content-Type: application/json');



include_once ('Nestoria.php');
$nestoria = new Nestoria();
$nestoria->setCoordenadas($_GET['coordenadas']['y'], $_GET['coordenadas']['x'],'0.2');
if (isset($_GET['filtros']) && count($_GET['filtros'])) {
    if (isset($_GET['filtros']['tipo'])){
        $nestoria->setListingType($_GET['filtros']['tipo']);
    }
    if (isset($_GET['filtros']['keywords'])){
        $nestoria->setFilters($_GET['filtros']['keywords']);
    }
}

echo $nestoria->get();