<?php

class Itransition_Shippinginsurance_Model_InsuranceInfo
{
    private $shippingMethodTitle;
    private $insuranceTypeLabel;
    private $insuranceType;
    private $insuranceCost;

    public function __construct($cost, $type, $label, $shippingMethodTitle)
    {
        $this->insuranceCost = $cost;
        $this->insuranceType = $type;
        $this->insuranceTypeLabel = $label;
        $this->shippingMethodTitle = $shippingMethodTitle;
    }

    public function getShippingMethodTitle()
    {
        return $this->shippingMethodTitle;
    }

    public function getInsuranceType()
    {
        return $this->insuranceType;
    }

    public function getInsuranceTypeLabel()
    {
        return $this->insuranceTypeLabel;
    }

    public function getInsuranceCost()
    {
        return $this->insuranceCost;
    }
}
