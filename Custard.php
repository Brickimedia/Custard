<?php

/**
 * Custard skin
 *
 * @file
 * @ingroup Skins
 * @author  Christopher Lazzaro <maestro35@outlook.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 * @version 1.0
 */

if ( !defined('MEDIAWIKI') ) {
    die( -1 );
}

$wgValidSkinNames['custard'] = 'Custard';
//$wgAutoloadClasses['SkinCustard'] = "$IP/skins/custard/Custard.skin.php";
$wgExtensionMessagesFiles['Custard'] = "$IP/skins/custard/Custard.i18n.php";

global $IP;

$wgResourceModules['skins.custard'] = array(
    'styles' => array(
        "$IP/skins/custard/CSS/custard.css" => array( 'media' => 'screen' ),
    ),
    'scripts' => array(
        "$IP/resources/jquery/jquery.funcToggle.js",
        "$IP/resources/jquery/jquery.jPlayer.min.js",
        "$IP/resources/jquery/jquery.jPlayer.playlist.min.js",
        "$IP/skins/custard/JS/custard.js",
    ),
    'remoteBasePath' => $GLOBALS['wgStylePath'],
    'localBasePath' => $GLOBALS['wgStyleDirectory'],
    'position' => 'top'
);

?>
