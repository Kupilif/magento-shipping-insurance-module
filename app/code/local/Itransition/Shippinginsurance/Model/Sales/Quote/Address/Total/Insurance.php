<?php

class Itransition_Shippinginsurance_Model_Sales_Quote_Address_Total_Insurance extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    protected $_code = 'insurance';

    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        parent::collect($address);

        $this->_setAmount(0);
        $this->_setBaseAmount(0);
        $items = $this->_getAddressItems($address);

        if (!count($items)) {
            return $this;
        }

        $quote = $address->getQuote();
        $helper = Mage::helper('shippinginsurance');
        $insuranceCost = $quote->getInsurance();

        if ($helper->isNecessaryToAddInsuranceToGrandTotal($insuranceCost)) {
            $address->setGrandTotal($address->getGrandTotal() + $insuranceCost);
            $address->setBaseGrandTotal($address->getBaseGrandTotal() + $insuranceCost);
        }
    }

    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        parent::fetch($address);

        $quote = $address->getQuote();
        $items = $this->_getAddressItems($address);

        if (!count($items)) {
            return $this;
        }

        $insuranceCost = $quote->getInsurance();
        $helper = Mage::helper('shippinginsurance');

        if ($helper->isNecessaryToAddInsuranceToGrandTotal($insuranceCost)) {
            $address->addTotal(array(
                'code'=>$this->getCode(),
                'title'=>$helper->__($helper::INSURANCE_ROW_LABEL),
                'value'=> $insuranceCost
            ));
        }

        return $this;
    }
}
