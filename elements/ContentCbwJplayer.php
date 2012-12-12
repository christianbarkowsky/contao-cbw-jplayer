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

/**
 * Class ContentImage
 *
 * Front end content element "image".
 * @copyright  Leo Feyer 2005-2012
 * @author     Leo Feyer <http://contao.org>
 * @package    Core
 */
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
		
		$multiMP3SRC = deserialize($this->multiMP3SRC);

		// Return if there are no files
		if (!is_array($multiMP3SRC) || empty($multiMP3SRC))
		{
			return '';
		}
		
		// Get the file entries from the database
		$objFiles = \FilesModel::findMultipleByIds($multiMP3SRC);

		if ($objFiles === null)
		{
			return '';
		}
		
		// Get all files
		while ($objFiles->next())
		{
			// Continue if the files has been processed or does not exist
			if (isset($files[$objFiles->path]) || !file_exists(TL_ROOT . '/' . $objFiles->path))
			{
				continue;
			}
			
			$arrMeta = $this->getMetaData($objFiles->meta, $objPage->language);
			
			// Use the file name as title if none is given
			if ($arrMeta['title'] == '')
			{
				$arrMeta['title'] = specialchars(str_replace('_', ' ', preg_replace('/^[0-9]+_/', '', $objFile->filename)));
			}
			
			// Add the image
			$files[$objFiles->path] = array
			(
				'id'        => $objFiles->id,
				'name'      => $objFile->basename,
				'title'     => $arrMeta['title'],
				'link'      => $arrMeta['title'],
				'caption'   => $arrMeta['caption'],
				'href'      => \Environment::get('request') . (($GLOBALS['TL_CONFIG']['disableAlias'] || strpos(\Environment::get('request'), '?') !== false) ? '&amp;' : '?') . 'file=' . $this->urlEncode($objFiles->path),
				'filesize'  => $this->getReadableSize($objFile->filesize, 1),
				'icon'      => TL_FILES_URL . 'system/themes/' . $this->getTheme() . '/images/' . $objFile->icon,
				'mime'      => $objFile->mime,
				'meta'      => $arrMeta,
				'extension' => $objFile->extension,
				'path'      => $objFile->dirname,
				'filename'  => $this->urlEncode($objFiles->path)
			);
		}
		
		$this->Template->id = $this->id;
		$this->Template->files = array_values($files);
	}
}

?>