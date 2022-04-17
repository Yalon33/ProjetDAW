<?php
    $SUCCES = 0;
    $ECHEC = 0;

    function failedTest($nomTest){
        GLOBAL $ECHEC;
        $ECHEC ++;
        echo "[<font color='red'>FAIL</font>] $nomTest<br>";
        BDD::query("ROLLBACK;");
    }

    function succeededTest($nomTest){
        GLOBAL $SUCCES;
        $SUCCES++;
        echo "[<font color='blue'>SUCCES</font>] $nomTest<br>";
        BDD::query("ROLLBACK;");
    }

    function affiche_resultat(){
        GLOBAL $SUCCES, $ECHEC;
        echo "<br><b>Synthèse: Testés: <font color='blue'>". $SUCCES + $ECHEC . "</font> 
        | Réussi: <font color='green'>$SUCCES</font> 
        | Échoués: <font color='red'>$ECHEC</font></b><br>";
    }

?>