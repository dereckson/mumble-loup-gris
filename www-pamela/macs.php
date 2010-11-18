<?php
    //echo json_encode($players);
    $players = `/home/dereckson/scripts/user/mumble-who`;
    if ($players) {
        $players = trim($players);
        $players = iconv("ISO-8859-1", "UTF-8", $players);
        $players = explode(" ", $players);
        echo json_encode($players);
    } else {
        echo '[]';
    }
?>
