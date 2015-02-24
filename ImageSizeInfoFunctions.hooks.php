<?php
/**
 * ImageSizeInfoFunctions
 * ImageSizeInfoFunctions Hooks
 *
 * @author		Tim Aldridge
 * @license		GNU GPL v2.0
 * @package		ImageSizeInfoFunctions
 * @link		https://github.com/CurseStaff/ImageSizeInfoFunctions
 *
 **/
class ImageSizeInfoFunctionsHooks {
	/**
	 * Sets up this extension's parser functions.
	 *
	 * @access	public
	 * @param	object	Parser object passed as a reference.
	 * @return	boolean	true
	 */
	static public function onParserFirstCallInit( Parser &$parser ) {
		$parser->setFunctionHook( "imgw", "ImageSizeInfoFunctionHooks::getImageWidth");
		$parser->setFunctionHook( "imgh", "ImageSizeInfoFunctionHooks::getImageHeight");
		return true;
	}

	/**
	 * Function for when the parser object is being cleared.
	 * @see	https://www.mediawiki.org/wiki/Manual:Hooks/ParserClearState
	 *
	 * @param $parser
	 * @return bool
	 */
	static public function onParserClearState( &$parser ) {
		return true;
	}

	static public function getImageWidth( &$parser, $image = '' ) {
		try {
			$title = Title::newFromText( $image, NS_IMAGE );
			$file = function_exists( 'wfFindFile' ) ? wfFindFile( $title ) : new Image( $title );
			$width = ( is_object( $file ) && $file->exists() ) ? $file->getWidth() : 0;
			return $width;
		} catch ( Exception $e ) {
			return wfMessage( 'error' )->text();
		}
	}

	static public function getImageHeight( &$parser, $image = '' ) {
		try {
			$title = Title::newFromText( $image, NS_IMAGE );
			$file = function_exists( 'wfFindFile' ) ? wfFindFile( $title ) : new Image( $title);
			$height = ( is_object( $file ) && $file->exists() ) ? $file->getHeight() : 0;
			return $height;
		} catch ( Exception $e ) {
			return wfMessage( 'error' )->text();
		}
	}
}
