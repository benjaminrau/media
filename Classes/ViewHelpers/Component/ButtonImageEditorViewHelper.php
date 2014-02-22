<?php
namespace TYPO3\CMS\Media\ViewHelpers\Component;
/***************************************************************
*  Copyright notice
*
*  (c) 2013 Fabien Udriot <fabien.udriot@typo3.org>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
use TYPO3\CMS\Backend\Utility\IconUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Media\Utility\ModuleUtility;
use TYPO3\CMS\Vidi\Domain\Model\Content;
use TYPO3\CMS\Vidi\ModulePlugin;

/**
 * View helper which renders a "image-editor" button to be placed in the grid.
 */
class ButtonImageEditorViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @var \TYPO3\CMS\Vidi\ViewHelpers\Uri\EditViewHelper
	 * @inject
	 */
	protected $uriEditViewHelper;

	/**
	 * Renders a "image-editor" button to be placed in the grid.
	 *
	 * @param Content $object
	 * @return string
	 */
	public function render(Content $object = NULL) {
		$result = '';
		if (ModulePlugin::getInstance()->isPluginRequired('imageEditor')) {
			$result = sprintf('<a href="%s&%s[asset]=%s" class="btn-imageEditor" data-uid="%s" title="%s">%s</a>',
				ModuleUtility::getUri('show', 'ImageEditor'),
				ModuleUtility::getParameterPrefix(),
				$object->getUid(),
				$object->getUid(),
				LocalizationUtility::translate('edit_image', 'media'),
				IconUtility::getSpriteIcon('extensions-media-image-edit')
			);
		}
		return $result;
	}
}
