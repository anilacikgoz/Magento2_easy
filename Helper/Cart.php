<?php

namespace Dibs\EasyCheckout\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Cart
 * @package Dibs\EasyCheckout\Helper
 */
class Cart extends AbstractHelper
{

    /**
     * dibs_easycheckout/crosssell/
     */
    const XML_PATH_CROSSSELL = 'dibs_easycheckout/crosssell/';
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Cart constructor.
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager
    )
    {
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * @return Current Currency code
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCurrencyCode()
    {
        return $this->storeManager->getStore()->getCurrentCurrency()->getCode();
    }

    /**
     * @param null $store
     * @return mixed
     */
    public function isDisplayCrosssell($store = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_CROSSSELL . 'display_crosssell',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * @param null $store
     * @return mixed
     */
    public function getNumberOfCrosssellProducts($store = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_CROSSSELL . 'crosssell_limit',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }
}