<?php
namespace TYPO3\CMS\Media\Grid;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012-2013 Fabien Udriot <fabien.udriot@typo3.org>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Media\ObjectFactory;
use TYPO3\CMS\Media\Service\ThumbnailInterface;
use TYPO3\CMS\Media\Utility\ModuleUtility;
use TYPO3\CMS\Vidi\Grid\GridRendererAbstract;
use TYPO3\CMS\Vidi\ModulePlugin;

/**
 * Class rendering the preview of a media in the Grid.
 */
class PreviewRenderer extends GridRendererAbstract {

	/**
	 * @var \TYPO3\CMS\Media\Service\ThumbnailService
	 */
	protected $thumbnailService;

	/**
	 * @var \TYPO3\CMS\Media\ViewHelpers\MetadataViewHelper
	 */
	protected $metadataViewHelper;

	/**
	 * @return \TYPO3\CMS\Media\Grid\PreviewRenderer
	 */
	public function __construct() {
		$this->thumbnailService = GeneralUtility::makeInstance('TYPO3\CMS\Media\Service\ThumbnailService');
		$this->metadataViewHelper = GeneralUtility::makeInstance('TYPO3\CMS\Media\ViewHelpers\MetadataViewHelper');
	}

	/**
	 * Render a preview of a file in the Grid.
	 *
	 * @return string
	 */
	public function render() {

		$asset = ObjectFactory::getInstance()->convertContentObjectToAsset($this->object);

		$uri = FALSE;
		$appendTime = TRUE;

		// Compute image-editor or link-creator URL.
		if (ModulePlugin::getInstance()->isPluginRequired('imageEditor')) {
			$appendTime = FALSE;
			$uri = sprintf('%s&%s[asset]=%s',
				ModuleUtility::getUri('show', 'ImageEditor'),
				ModuleUtility::getParameterPrefix(),
				$this->object->getUid()
			);
		} elseif (ModulePlugin::getInstance()->isPluginRequired('linkCreator')) {
			$appendTime = FALSE;
			$uri = sprintf('%s&%s[asset]=%s',
				ModuleUtility::getUri('show', 'LinkCreator'),
				ModuleUtility::getParameterPrefix(),
				$this->object->getUid()
			);
		}

		$result = $this->thumbnailService->setFile($asset)
			->setOutputType(ThumbnailInterface::OUTPUT_IMAGE_WRAPPED)
			->setAppendTimeStamp($appendTime)
			->setTarget(ThumbnailInterface::TARGET_BLANK)
			->setAnchorUri($uri)
			->create();

		$template = '%s K';
		$metadata = array('size');

		if ($asset->getType() == File::FILETYPE_IMAGE) {
			$template = '%s x %s';
			$metadata = array('width', 'height');
		}

		$result .= $this->metadataViewHelper->render($asset, $template, $metadata);
		return $result;
	}
}
