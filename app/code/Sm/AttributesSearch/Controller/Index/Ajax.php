<?php
/**
 * @category Magentech
 * @package Sm_AttributesSearch
 * @version 1.0.0
 * @copyright Copyright (c) 2018 YouTech Company. All Rights Reserved.
 * @license - Copyrighted Commercial Software
 * @author YouTech Company <contact@ytcvn.com>
 * @link http://www.magentech.com
 */

namespace Sm\AttributesSearch\Controller\Index;

use \Magento\Framework\App\Action\Context;

/**
 * Class Ajax
 * @package Sm\AttributesSearch\Controller\Index
 */
class Ajax extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\LayoutInterface
     */
    protected $layout;

    /**
     * Ajax constructor.
     * @param Context $context
     * @param \Magento\Framework\View\LayoutInterface $layoutInterface
     */
    public function __construct(
        Context $context,
        \Magento\Framework\View\LayoutInterface $layoutInterface
    ) {
        $this->layout = $layoutInterface;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $isAjax = $this->getRequest()->isAjax();
        if ($isAjax) {
            $this->layout->getUpdate()->load(['attributessearch_index_ajax']);
            $this->layout->generateXml();
            $output = $this->layout->getOutput();
            $this->getResponse()->representJson(
                $this->_objectManager->get(\Magento\Framework\Json\Helper\Data::class)
                    ->jsonEncode(array('contents' => $output))
            );
        }
    }
}