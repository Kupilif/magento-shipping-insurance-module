<?php

class Itransition_Shippinginsurance_Block_Order_Invoice_Totals extends Mage_Sales_Block_Order_Invoice_Totals
{
    protected $_code = 'insurance';

    protected function _initTotals()
    {
        parent::_initTotals();

        Mage::helper('shippinginsurance')->addInsuranceRowToTotals($this);

        return $this;
    }
}
