<?php

class Itransition_Shippinginsurance_Model_Sales_Order_Pdf_Total_Insurance extends Mage_Sales_Model_Order_Pdf_Total_Default
{
    public function getTotalsForDisplay()
    {
        $result = array();
        $insuranceCost = $this->getOrder()->getInsurance();
        $helper = Mage::helper('shippinginsurance');

        if ($helper->isNecessaryToAddInsuranceToGrandTotal($insuranceCost)) {
            $result[] = array(
                'amount' => sprintf('%.2f', $insuranceCost),
                'label' => $helper->__($helper::INSURANCE_ROW_LABEL),
                'font_size' => $this->getFontSize()
            );
        }

        return $result;
    }
}
