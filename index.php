<?php
include 'controller/ControllerAnnonce.php';


//Si j'ai une page demandée ($_GET['page'])
//Je verifie que cette page existe
//j'appel le traitement concerné
//sinon
//on renvoi vers register.html
$ControllerAnnonce = new ControllerAnnonce();

if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'newannonce':
            $ControllerAnnonce->displayNewAnnonce();
            return;
            break;
        case 'traitementnewannonce':
            $ControllerAnnonce->traitementNewAnnonce();
            return;
            break;
    }
}
else {
    $ControllerAnnonce->displayAnnonce();
}



