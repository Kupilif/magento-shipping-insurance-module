<?php

class Itransition_Shippinginsurance_Model_Sales_Order_Creditmemo_Total_Insurance extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{
    public function collect(Mage_Sales_Model_Order_Creditmemo $creditmemo)
    {
        $order = $creditmemo->getOrder();
        $helper = Mage::helper('shippinginsurance');
        $insuranceCost = $order->getInsurance();

        if ($helper->isNecessaryToAddInsuranceToGrandTotal($insuranceCost)) {
            $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $insuranceCost);
            $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $insuranceCost);
        }

        return $this;
    }
}
