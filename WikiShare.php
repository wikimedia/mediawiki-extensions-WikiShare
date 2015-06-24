<?php
/**
 * MediaWiki extension to add customizable social media share links to wiki pages and sidebar.
 * Installation instructions can be found on
 * https://www.mediawiki.org/wiki/Extension:WikiShare
 *
 * @addtogroup Extensions
 * @author Gregory Varnum (User:Varnent)
 * @license GPL
 *
 * Thank you to everyone who has helped with contributing ideas and cleaning up code.
 *
 * NOTE: THIS EXTENSION IS STILL IN VERY EARLY STAGES OF DEVELOPMENT AND NOT RECOMMENDED FOR USAGE YET.
 *
 */

/**
 * Exit if called outside of MediaWiki
 */
if( !defined( 'MEDIAWIKI' ) ) {
        echo( "This file is an extension to the MediaWiki software and cannot be used standalone.\n" );
        die( 1 );
}


/**
 * SETTINGS
 * --------
 * The following variables may be reset in your LocalSettings.php file.
 *
 * $wgWikiShareBackground
 * 			- Background color for WikiShare toolbox displayed in article header
 *			  Default is #f6f6f6
 * $wgWikiShareBorder
 * 			- Border color for WikiShare toolbox displayed in article header
 *			  Default is #a7d7f9
 * $wgWikiShareSidebar
 * 			- Display WikiShare widget as sidebar portlet
 *			  Default is true
 * $wgWikiShareHeader
 * 			- Display WikiShare widget in article headers
 *			  Default is true
 * $wgWikiShareMain
 * 			- Display WikiShare widget on main page
 *			  Default is true
 * $wgWikiShareSBServ[0]['service']
 * 			- Service name
 *			  Default is Facebook
 */

# Default values for most options
$wgWikiShareBackground = '#f6f6f6';
$wgWikiShareBorder	 = '#a7d7f9';
$wgWikiShareSidebar	 = true;
$wgWikiShareHeader	 = true;
$wgWikiShareMain		 = true;
$wgWikiShare = array(
	'addressbarsharing' => false,
);

# Sidebar settings
$wgWikiShareSBServ = array(
	array(
		'service' => 'Facebook',
        'url' => 'http://www.facebook.com/sharer.php?u=',
        'image' => 'https://upload.wikimedia.org/wikinews/en/5/55/Facebook.png',
	),
	array(
		'service' => 'Twitter',
        'url' => 'http://twitter.com/?status=Look%20what%20I%20found:%20',
        'image' => 'https://upload.wikimedia.org/wikinews/en/f/f7/Twitter.png',
	),
	array(
		'service' => 'Google+',
        'url' => 'https://plus.google.com/share?url=',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/4/42/Google%2B_icon_red.png',
	),
	array(
		'service' => 'LinkedIn',
        'url' => 'http://www.linkedin.com/shareArticle?mini=true&url=',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Linkedin.svg/16px-Linkedin.svg.png',
	),
	array(
		'service' => 'Digg',
        'url' => 'http://digg.com/submit?url=',
        'image' => 'https://upload.wikimedia.org/wikinews/en/9/95/Digg-icon.png',
	),
	array(
		'service' => 'delicious',
        'url' => 'http://delicious.com/post?url=',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Delicious.svg/16px-Delicious.svg.png',
	),
	array(
		'service' => 'reddit',
        'url' => 'http://reddit.com/submit?url=',
        'image' => 'https://upload.wikimedia.org/wikinews/en/1/10/Reddit.png',
	),
	array(
		'service' => 'StumbleUpon',
        'url' => 'http://stumbleupon.com/submit?url=',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/StumbleUpon_logo.png/16px-StumbleUpon_logo.png',
	),
);

# Toolbar settings
$wgWikiShareHServ = array(
	array(
		'service' => 'Facebook',
        'url' => 'http://www.facebook.com/sharer.php?u=',
        'image' => 'https://upload.wikimedia.org/wikinews/en/5/55/Facebook.png',
	),
	array(
		'service' => 'Twitter',
        'url' => 'http://twitter.com/?status=Look%20what%20I%20found:%20',
        'image' => 'https://upload.wikimedia.org/wikinews/en/f/f7/Twitter.png',
	),
	array(
		'service' => 'Google+',
        'url' => 'https://plus.google.com/share?url=',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/4/42/Google%2B_icon_red.png',
	),
	array(
		'service' => 'LinkedIn',
        'url' => 'http://www.linkedin.com/shareArticle?mini=true&url=',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Linkedin.svg/16px-Linkedin.svg.png',
	),
	array(
		'service' => 'Digg',
        'url' => 'http://digg.com/submit?url=',
        'image' => 'https://upload.wikimedia.org/wikinews/en/9/95/Digg-icon.png',
	),
	array(
		'service' => 'delicious',
        'url' => 'http://delicious.com/post?url=',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Delicious.svg/16px-Delicious.svg.png',
	),
	array(
		'service' => 'reddit',
        'url' => 'http://reddit.com/submit?url=',
        'image' => 'https://upload.wikimedia.org/wikinews/en/1/10/Reddit.png',
	),
	array(
		'service' => 'StumbleUpon',
        'url' => 'http://stumbleupon.com/submit?url=',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/StumbleUpon_logo.png/16px-StumbleUpon_logo.png',
	),
);

/**
 * Credits
 *
 */
$wgExtensionCredits['other'][] = array(
	'path'           => __FILE__,
	'name'           => 'WikiShare',
	'version'        => 'Alpha 0.1a20150624',
	'author'         => '[https://www.mediawiki.org/wiki/User:Varnent Gregory Varnum]',
	'description'    => 'Adds customizable social media share links to wiki pages and sidebar.',
	'descriptionmsg' => 'wikishare-desc',
	'url'            => 'https://www.mediawiki.org/wiki/Extension:WikiShare',
);

/**
 * Register class and localisations
 *
 */
$dir = dirname(__FILE__) . '/';
$wgAutoloadClasses['WikiShare'] = $dir . 'WikiShare.body.php';
$wgMessagesDirs['WikiShare'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['WikiShare'] = $dir . 'WikiShare.i18n.php';

$wgResourceModules['ext.wikiShare.main'] = array(
	'localBasePath' => __DIR__,
	'remoteExtPath' => 'WikiShare',
    
	'styles' => 'resources/wikiShare.css',
);

/**
 * Hooks
 *
 */
$wgHooks['ArticleViewHeader'][] = 'WikiShare::WikiShareHeader';
$wgHooks['ParserFirstCallInit'][] = 'WikiShare::WikiShareHeaderTag';
$wgHooks['SkinBuildSidebar'][] = 'WikiShare::WikiShareSidebar';
