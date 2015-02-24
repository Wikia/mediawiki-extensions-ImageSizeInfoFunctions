<?php
/**
 * ImageSizeInfoFunctions
 * ImageSizeInfoFunctions Mediawiki Settings
 *
 * @author		Tim Aldridge
 * @license		GNU GPL v2.0
 * @package		ImageSizeInfoFunctions
 * @link		https://github.com/CurseStaff/ImageSizeInfoFunctions
 *
 **/
/******************************************/
/* Credits								  */
/******************************************/
$credits = [
	'path'				=>	__FILE__,
	'name'				=>	'ImageSizeInfoFunctions',
	'url'				=>	'http://www.mediawiki.org/wiki/Extension:ImageSizeInfoFunctions',
	'author'			=>	array( 'Dario de Judicibus', 'Curse Inc', 'Wiki Platform Team'),
	'descriptionmsg'	=>	'imagesizeinfofunctions_description',
	'version'			=>	'1.1.0'
];
$wgExtensionCredits['other'][] = $credits;

/******************************************/
/* Language Strings, Page Aliases, Hooks  */
/******************************************/
$extDir = __DIR__;

$wgExtensionMessageFiles['ImageSizeInfoFunctions']			= $extDir . "/ImageSizeInfoFunctions.i18n.php";
$wgExtensionMessageFiles['ImageSizeInfoFunctionsMagic']		= $extDir . "/ImageSizeInfoFunctions.i18n.magic.php";
$wgMessagesDir['ImageSizeInfoFunctions']					= $extDir . "/i18n";

$wgAutoloadClasses['ImageSizeInfoFunctionsHooks']			= $extDir . "/ImageSizeInfoFunctions.hooks.php";

$wgHooks['ParserFirstCallInit'][]							= 'ImageSizeInfoFunctionsHooks::onParserFirstCallInit';
$wgHooks['ParserClearState'][]								= 'ImageSizeInfoFunctionsHooks::onParserClearState';

