<?php

class Itransition_Shippinginsurance_Block_InsuranceSelect extends Mage_Checkout_Block_Onepage_Abstract
{
    public function isInsuranceModuleEnabled()
    {
        return Mage::helper('shippinginsurance')->isInsuranceModuleEnabled();
    }

    public function calculateInsuranceForActiveCarriers()
    {
        $result = array();
        $helper = Mage::helper('shippinginsurance');
        $shippingMethods = Mage::getSingleton('shipping/config')->getActiveCarriers();
        $subtotal = $this->getQuote()->getSubtotal();

        foreach ($shippingMethods as $shippingCode => $shippingModel) {
            if ($helper->isInsuranceEnabledForShippingMethod($shippingCode)) {
                $result[] = $helper->calculateInsurance($shippingCode, $subtotal);
            }
        }

        return $result;
    }
}
