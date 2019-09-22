<?php

class Itransition_Shippinginsurance_Model_Sales_Order_Invoice_Total_Insurance extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
        $order = $invoice->getOrder();
        $helper = Mage::helper('shippinginsurance');
        $insuranceCost = $order->getInsurance();

        if ($helper->isNecessaryToAddInsuranceToGrandTotal($insuranceCost)) {
            $invoice->setGrandTotal($invoice->getGrandTotal() + $insuranceCost);
            $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $insuranceCost);
        }

        return $this;
    }
}
