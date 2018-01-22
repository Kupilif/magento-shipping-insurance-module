<?php

class Itransition_Shippinginsurance_Model_Observer
{
    const INSURANCE_ENABLED = 'enabled';
    const INSURANCE_ENABLED_PARAMETER = 'use_insurance';

    public function checkoutControllerOnepageSaveShippingMethod($observer)
    {
        $helper = Mage::helper('shippinginsurance');
        $quote = $observer->getEvent()->getData('quote');
        $request = $observer->getEvent()->getData('request');
        $insuranceStatus = $request->getPost(self::INSURANCE_ENABLED_PARAMETER);
        $shippingCode = $helper->getCorrectShippingMethodCode($quote->getShippingAddress()->getShippingMethod());

        if ($insuranceStatus === self::INSURANCE_ENABLED) {
            $helper->updateInsuranceCost($shippingCode, $quote);
        } else {
            $quote->setInsurance(null);
        }
    }

    public function salesQuoteItemQtySetAfter($observer)
    {
        $helper = Mage::helper('shippinginsurance');
        $quote = $observer->getEvent()->getData('item')->getQuote();
        $shippingMethod = $quote->getShippingAddress()->getShippingMethod();
        $insuranceCost = $quote->getInsurance();
        $shippingCode = $helper->getCorrectShippingMethodCode($quote->getShippingAddress()->getShippingMethod());

        if (($shippingMethod !== null) && ($insuranceCost !== null)) {
            $helper->updateInsuranceCost($shippingCode, $quote);
        }
    }
}
