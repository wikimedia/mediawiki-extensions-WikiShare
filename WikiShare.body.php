<?php
if (!defined('MEDIAWIKI')) die();
/**
 * Class file for the WikiShare extension
 *
 * @addtogroup Extensions
 * @license GPL
 */
class WikiShare {

	/**
	 * Register parser hook
	 *
	 * @param $parser Parser
	 * @return bool
	 */
	public static function WikiShareHeaderTag( &$parser ) {
		$parser->setHook( 'wikishare', __CLASS__.'::parserHook' );
		return true;
	}

	/**
	 * Parser hook for the <wikishare /> tag extension.
	 *
	 * @param $parser
	 * @return string
	 */
	 static function parserHook( $parser ) {
		global $wgWikiShare, $wgWikiSharepubid, $wgWikiShareHServ, $wgWikiShareBackground, $wgWikiShareBorder;

		# Load css stylesheet
		$wgOut->addModuleStyles( 'ext.wikiShare.main' );

		# Output WikiShare widget
		$output ='<!-- WikiShare Button BEGIN -->
			<div id="wikisharetoolbar" style="background:'.$wgWikiShareBackground.'; border-color:'.$wgWikiShareBorder.';">';

		$output .= self::makeLinks( $wgWikiShareHServ );

        $output .='</div>';

		return $output;
	}

/**
 * Function to setup article URL and title for service URLs
 *
 * @param $article
 * @return bool
 */ 
    


	/**
	 * Function for article header toolbar
	 *
	 * @param $article Article
	 * @param $outputDone
	 * @param $pcache
	 * @return bool|bool
	 */
	public static function WikiShareHeader( &$article, &$outputDone, &$pcache ) {
		global $wgOut, $wgWikiShare, $wgWikiShareHeader, $wgWikiShareMain,
		       $wgWikiShareHServ, $wgWikiShareBackground, $wgWikiShareBorder;

		# Check if page is in content namespace and the setting to enable/disable article header tooblar either on the main page or at all
		if ( !MWNamespace::isContent( $article->getTitle()->getNamespace() )
			|| !$wgWikiShareHeader
			|| ( $article->getTitle()->equals( Title::newMainPage() ) && !$wgWikiShareMain )
		) {
			return true;
		}
        
		# Load css stylesheet
		$wgOut->addModuleStyles( 'ext.wikiShare.main' );

		# Output WikiShare widget
		$wgOut->addHTML('<!-- WikiShare Button BEGIN -->
			<div id="wikisharetoolbar" style="background:'.$wgWikiShareBackground.'; border-color:'.$wgWikiShareBorder.';">');
		
        $wgOut->addHTML( self::makeLinks( $wgWikiShareHServ ) );
        
		$wgOut->addHTML('</div>');

		return true;
	}

	/**
	 * Function for sidebar portlet
	 *
	 * @param $skin
	 * @param $bar
	 * @return bool|array|bool
	 */
	public static function WikiShareSidebar( $skin, &$bar ) {
		global $wgOut, $wgWikiShare, $wgWikiShareSidebar, $wgWikiShareSBServ;

		# Check setting to enable/disable sidebar portlet
		if ( !$wgWikiShareSidebar ) {
			return true;
		}

		# Localisation for "Share"
		$share = wfMessage( 'wikishare-share' )->escaped();
        
		# Load css stylesheet
		$wgOut->addModuleStyles( 'ext.wikiShare.main' );

		# Output WikiShare widget
		$bar['wikishare-share'] = '<!-- WikiShare Button BEGIN -->
			<div id="wikisharesidebar">';

		$bar['wikishare-share'] .= self::makeLinks( $wgWikiShareSBServ );

		$bar['wikishare-share'] .= '</div>';

		return true;
	}    

	/**
	 * Converts an array definition of links into HTML tags
	 *
	 * @param $links array
	 * @return string
	 */
    protected static function makeLinks( $links ) {
		global $wgOut;
        $articlefullurl = urlencode( $wgOut->getTitle()->getFullURL() );
		
        $html = '';
		foreach ( $links as $link ) {
			$html .= '<a class="wikishare_button wikishare_button_' . $link['service'] . '" href="' . $link['url'] . '' . $articlefullurl .'" title="Share on ' . $link['service'] . '"><img alt="Share on ' . $link['service'] . '" src="' . $link['image'] . '"></a>';
		}

		return $html;
	}
}