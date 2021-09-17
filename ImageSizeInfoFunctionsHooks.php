<?php
/**
 * ImageSizeInfoFunctions
 * ImageSizeInfoFunctions Hooks
 *
 * @license		GPL-2.0-or-later
 * @package		ImageSizeInfoFunctions
 * @link		https://github.com/CurseStaff/ImageSizeInfoFunctions
 *
 */
class ImageSizeInfoFunctionsHooks {
	/**
	 * Sets up this extension's parser functions.
	 *
	 * @param Parser $parser Parser object passed as a reference.
	 * @return bool true
	 */
	public static function onParserFirstCallInit( Parser $parser ) {
		$parser->setFunctionHook( "imgw", "ImageSizeInfoFunctionsHooks::getImageWidth" );
		$parser->setFunctionHook( "imgh", "ImageSizeInfoFunctionsHooks::getImageHeight" );

		return true;
	}

	/**
	 * Function for when the parser object is being cleared.
	 * @see	https://www.mediawiki.org/wiki/Manual:Hooks/ParserClearState
	 *
	 * @param Parser $parser
	 * @return bool
	 */
	public static function onParserClearState( Parser $parser ) {
		return true;
	}

	/**
	 * Function to get the width of the image.
	 *
	 * @param Parser $parser object passed a reference
	 * @param string $image Name of the image being parsed in
	 * @return mixed integer of the width or error message.
	 */
	public static function getImageWidth( Parser $parser, $image = '' ) {
		if ( !$parser->incrementExpensiveFunctionCount() ) {
			return wfMessage( 'error_returning_width' )->text();
		}
		try {
			$title = Title::newFromText( $image, NS_FILE );
			$file = wfFindFile( $title );
			$width = ( is_object( $file ) && $file->exists() ) ? $file->getWidth() : 0;
			return $width;
		} catch ( Exception $e ) {
			return wfMessage( 'error_returning_width' )->text();
		}
	}

	/**
	 * Function to get the height of the image.
	 *
	 * @param Parser $parser Parser object passed a reference
	 * @param string $image Name of the image being parsed in
	 * @return mixed integer of the height or error message.
	 */
	public static function getImageHeight( Parser $parser, $image = '' ) {
		if ( !$parser->incrementExpensiveFunctionCount() ) {
			return wfMessage( 'error_returning_height' )->text();
		}
		try {
			$title = Title::newFromText( $image, NS_FILE );
			$file = wfFindFile( $title );
			$height = ( is_object( $file ) && $file->exists() ) ? $file->getHeight() : 0;
			return $height;
		} catch ( Exception $e ) {
			return wfMessage( 'error_returning_height' )->text();
		}
	}
}
