<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package Calendar
 * @link    http://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'Contao\ContentCbwJplayer' => 'system/modules/cbw_jplayer/elements/ContentCbwJplayer.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_cbw_jplayer'        => 'system/modules/cbw_jplayer/templates',
));
