<?php
    $t1 = time();
    $t2 = time() - 300000;
    
    $d1 = date("Y-m-d", $t1);
    $d2 = date('Y-m-d', $t2);
    
    if ($d1 > $d2){
        echo "sensible";
    }
    if ($d2 > $d1){
        echo "insensible";
    }

    echo <<<_END
    
_END
?>