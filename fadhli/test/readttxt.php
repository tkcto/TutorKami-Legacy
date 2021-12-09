<?php 
$handle = fopen("../../admin/Log-SalesTutorkami2021.txt","r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        echo $line.'<br/>';
    }

    fclose($handle);
} else {
    // error opening the file.
} 
?>