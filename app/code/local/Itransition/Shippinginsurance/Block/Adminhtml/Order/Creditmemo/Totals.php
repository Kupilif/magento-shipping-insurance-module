<?php

class Itransition_Shippinginsurance_Block_Adminhtml_Order_Creditmemo_Totals extends Mage_Adminhtml_Block_Sales_Order_Creditmemo_Totals
{
    protected $_code = 'insurance';

    protected function _initTotals()
    {
        parent::_initTotals();

        Mage::helper('shippinginsurance')->addInsuranceRowToTotals($this);

        return $this;
    }
}
