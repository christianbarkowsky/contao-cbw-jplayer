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
 
/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Contao;


class ContentCbwJplayer extends \ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_cbw_jplayer';


	/**
	 * Return if the image does not exist
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### CBW JPLAYER ###';
			return $objTemplate->parse();
		}

		return parent::generate();
	}


	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		global $objPage;
	
		$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/cbw_jplayer/assets/js/jquery.jplayer.min.js';
		
		$objMp3File = \FilesModel::findByPk($this->singleMP3SRC);

		if ($objMp3File === null || !is_file(TL_ROOT . '/' . $objMp3File->path))
		{
			return '';
		}
		else
		{
			$this->Template->mp3filename = pathinfo($objMp3File->path, PATHINFO_FILENAME);
			$this->Template->mp3filepath = pathinfo($objMp3File->path, PATHINFO_DIRNAME);
		}
		
		$objOggFile = \FilesModel::findByPk($this->singleOGGSRC);

		if ($objOggFile === null || !is_file(TL_ROOT . '/' . $objOggFile->path))
		{
			return '';
		}
		else
		{
			$this->Template->oggfilename = pathinfo($objOggFile->path, PATHINFO_FILENAME);
			$this->Template->oggfilepath = pathinfo($objOggFile->path, PATHINFO_DIRNAME);
		}
		
		$this->Template->id = $this->id;		
	}
}

?>