<?php
/**
 * Who's online Mumble list
 *
 * @packah      mumble-loup-gris
 * @subpackage  www-list
 * @author      Sébastien Santoro aka Dereckson <dereckson@espace-win.org>
 * @copyright   2010 Sébastien Santoro aka Dereckson
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD
 * @version     0.1
 */

//Handles xmlHttpRequest
require("Sajax.php");

sajax_init();
sajax_export("get_players");
sajax_handle_client_request();

/**
 * Gets the list of the online players.
 *
 * @return string The HTML block with the players on the server.
 */
function get_players () {
    //Gets players
    $players = `/home/dereckson/scripts/user/mumble-who`;
    $players = trim($players);
    $players = iconv("ISO-8859-1", "UTF-8", $players);
    $players = split(" ", $players);

    //Prints them
    $count = count($players);
    if ($count == 0) {
        //Nobodoy on the server
        $buffer = "\t\t<p>Shh... the books are sleeping.</p>";
    } elseif ($count < 5) {
        //One column layout
        $buffer = "\t\t<ul class=\"players\">\n";
        foreach ($players as $player) {
            $buffer .= "\t\t\t\t<li>$player</li>\n";
        }
        $buffer .= "\t\t</ul>";
    } else {
        //Two columns layout
        $split_at = (int)($count / 2);
        if ($count % 2 == 1) $split_at++;
        $players_col1 = array_slice($players, 0, $split_at);
        $players_col2 = array_slice($players, $split_at);
        $buffer = "\t\t<div style=\"width: 48%; float: left;\">\n";
        $buffer .= "\t\t\t<ul class=\"players\">\n";
        foreach ($players_col1 as $player) {
            $buffer .= "\t\t\t\t<li class=\"player\">$player</li>\n";
        }
        $buffer .= "\t\t\t</ul>\n";
        $buffer .= "\t\t</div>\n\t\t<div style=\"width: 48%; float: right;\">\n";
        $buffer .= "\t\t\t<ul class=\"players\">\n";
        foreach ($players_col2 as $player) {
            $buffer .= "\t\t\t\t<li class=\"player\">$player</li>\n";
        }
        $buffer .= "\t\t\t</ul>\n";
        $buffer .= "\t\t</div>";
    }
    return $buffer;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<link href="list.css" rel="stylesheet" type="text/css">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Serveur Mumble Les Loups Gris</title>
	<script>
<?php sajax_show_javascript(); ?>

                function refresh_content () {
                    x_get_players(refresh_content_cb);
                }

                function refresh_content_cb (content) {
                    document.getElementById("content").innerHTML = content;
                    setTimeout("refresh_content()", 15000);
                }
	</script>
</head>
<body>
	<h1>Serveur Mumble<br />« Les Loups Gris »</h1>
	<hr />
	<div id="content">
<?php echo get_players(); ?>
        </div>
	<script>refresh_content();</script>
</body>
</html>
