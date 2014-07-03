<?php
/**
 * Custard skin
 *
 * @file
 * @ingroup Skins
 * @author Christopher Lazzaro <maestro35@outlook.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 * @version 1.0
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( -1 );
}

// Skin credits that will show up on Special:Version
$wgExtensionCredits['skin'][] = array(
	'path' => __FILE__,
	'name' => 'Custard',
	'version' => '1.0',
	'author' => 'Christopher Lazzaro',
	'description' => 'Custard skin', // @todo Better description
	'url' => 'https://www.mediawiki.org/wiki/Skin:Custard',
);

$wgValidSkinNames['custard'] = 'Custard';
$wgAutoloadClasses['SkinCustard'] = __DIR__ . '/custard/Custard.skin.php';
$wgExtensionMessagesFiles['Custard'] = __DIR__ . '/custard/Custard.i18n.php';

$wgResourceModules['skins.custard'] = array(
	'styles' => array(
		'skins/Custard/custard/CSS/custard.css' => array( 'media' => 'screen' ),
	),
	'position' => 'top'
);

$wgResourceModules['skins.custard.js'] = array(
	'scripts' => array(
		'skins/Custard/custard/JS/funcToggle.js',
		'skins/Custard/custard/JS/TweenLite.min.js',
		//'skins/Custard/custard/JS/CSSPlugin.min.js',	  - do not need yet, saving pageload time for now
		//'skins/Custard/custard/JS/ScrollToPlugin.min.js', - " "
		//'skins/Custard/custard/JS/EasePack.min.js',	   - " "
		//'skins/Custard/custard/JS/AttrPlugin.min.js',	 - " "
		'skins/Custard/custard/JS/custard.js',
	),
	'position' => 'top'
);