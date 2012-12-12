<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Christian Barkowsky 2012
 * @author     Christian Barkowsky <http://www.christianbarkowsky.de>
 * @package    Frontend
 * @license    LGPL
 * @filesource
 */
 
 
$GLOBALS['TL_DCA']['tl_content']['palettes']['cbw_jplayer'] = '{type_legend},type,headline;{source_legend},multiMP3SRC';
 
 
 
 
$GLOBALS['TL_DCA']['tl_content']['fields']['multiMP3SRC'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['multiMP3SRC'],
	'exclude'                 => true,
	'inputType'               => 'fileTree',
	'eval'                    => array('multiple'=>true, 'fieldType'=>'checkbox', 'files'=>true, 'filesOnly' => true, 'mandatory'=>true, 'extensions' => 'ogg'),
	'sql'                     => "blob NULL"
);
 
 ?>