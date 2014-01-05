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

$dir = dirname(__FILE__) . '/';

$wgValidSkinNames['custard'] = 'Custard';
$wgAutoloadClasses['SkinCustard'] = $dir . 'custard/Custard.skin.php';
$wgExtensionMessagesFiles['Custard'] = $dir . 'custard/Custard.i18n.php';

$wgResourceModules['skins.custard'] = array(
    'styles' => array(
        'skins/Custard/custard/CSS/custard.css' => array( 'media' => 'screen' ),
    ),
    'scripts' => array(
        //'resources/jquery.effects/jquery.effects.drop.js',
        'skins/Custard/custard/JS/funcToggle.js',
        //'skins/Custard/custard/JS/jPlayer.min.js',
        //'skins/Custard/custard/JS/jPlayer.playlist.min.js',
        'skins/Custard/custard/JS/custard.js',
    ),
    'dependencies' => array(
        'jquery.effects.drop',
    ),
    'position' => 'top'
);

unset( $dir );

?>
