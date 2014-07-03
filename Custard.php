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
		'skins/Custard/custard/JS/funcToggle.js',
        'skins/Custard/custard/JS/TweenLite.min.js',
        //'skins/Custard/custard/JS/CSSPlugin.min.js',      - do not need yet, saving pageload time for now
        //'skins/Custard/custard/JS/ScrollToPlugin.min.js', - " "
        //'skins/Custard/custard/JS/EasePack.min.js',       - " "
        //'skins/Custard/custard/JS/AttrPlugin.min.js',     - " "
		'skins/Custard/custard/JS/custard.js',
	),
	'position' => 'top'
);

unset( $dir );

?>
