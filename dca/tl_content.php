<?php
 
$GLOBALS['TL_DCA']['tl_content']['palettes']['cbw_jplayer'] = '{type_legend},type,headline;{source_legend},singleMP3SRC,singleOGGSRC';

$GLOBALS['TL_DCA']['tl_content']['fields']['singleMP3SRC'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['singleMP3SRC'],
	'exclude'                 => true,
	'inputType'               => 'fileTree',
	'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly' => true, 'mandatory'=>true, 'extensions' => 'mp3'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['singleOGGSRC'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['singleOGGSRC'],
	'exclude'                 => true,
	'inputType'               => 'fileTree',
	'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly' => true, 'mandatory'=>true, 'extensions' => 'ogg'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);
 
?>