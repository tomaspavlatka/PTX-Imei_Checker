<?php
/**
 * Author: Tomas Pavlatka (tomas.pavlatka@gmail.com)
 * Created: Jan 23, 2011
 */

// Required class.
require_once 'imeichecker.class.php';

// Variable init.
$imei = '490154203237518';

$checkerObj =& new PTX_ImeiChecker();

if($checkerObj->isValid($imei)) {
    echo 'IMEI: '.$imei.' IS valid.';
} else {
    echo 'IMEI: '.$imei.' IS NOT valid.';
}


