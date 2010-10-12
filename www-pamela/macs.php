<?php
    //echo json_encode($macs);
    $macs = `/home/dereckson/scripts/user/mumble-who`;
    $macs = trim($macs);
    $macs = iconv("ISO-8859-1", "UTF-8", $macs);
    $macs = split(" ", $macs);
    echo json_encode($macs);
?>
