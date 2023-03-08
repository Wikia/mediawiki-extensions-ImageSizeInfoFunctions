<?php

use MediaWiki\Hook\ParserFirstCallInitHook;

/**
 * ImageSizeInfoFunctions
 * ImageSizeInfoFunctions Hooks
 *
 * @license		GPL-2.0-or-later
 * @package		ImageSizeInfoFunctions
 * @link		https://github.com/CurseStaff/ImageSizeInfoFunctions
 *
 */
class ImageSizeInfoFunctionsHooks implements ParserFirstCallInitHook {

	/**
	 * @param RepoGroup $repoGroup
	 */
	public function __construct( private RepoGroup $repoGroup ) {
	}

	/**
	 * Sets up this extension's parser functions.
	 *
	 * @param Parser $parser Parser object passed as a reference.
	 * @return bool true
	 */
	public function onParserFirstCallInit( $parser ): bool {
		$parser->setFunctionHook( "imgw", [ $this, 'getImageWidth' ] );
		$parser->setFunctionHook( "imgh", [ $this, 'getImageHeight' ] );

		return true;
	}

	/**
	 * Function to get the width of the image.
	 *
	 * @param Parser $parser object passed a reference
	 * @param string $image Name of the image being parsed in
	 * @return mixed integer of the width or error message.
	 */
	public function getImageWidth( Parser $parser, $image = '' ) {
		if ( !$parser->incrementExpensiveFunctionCount() ) {
			return wfMessage( 'error_returning_width' )->text();
		}
		try {
			$title = Title::newFromText( $image, NS_FILE );
			$file = $this->repoGroup->findFile( $title );
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
	public function getImageHeight( Parser $parser, $image = '' ) {
		if ( !$parser->incrementExpensiveFunctionCount() ) {
			return wfMessage( 'error_returning_height' )->text();
		}
		try {
			$title = Title::newFromText( $image, NS_FILE );
			$file = $this->repoGroup->findFile( $title );
			$height = ( is_object( $file ) && $file->exists() ) ? $file->getHeight() : 0;
			return $height;
		} catch ( Exception $e ) {
			return wfMessage( 'error_returning_height' )->text();
		}
	}
}
