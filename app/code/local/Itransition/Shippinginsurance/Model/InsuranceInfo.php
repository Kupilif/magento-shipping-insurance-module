<?php

class Itransition_Shippinginsurance_Model_InsuranceInfo
{
    private $shippingMethodTitle;
    private $insuranceTypeLabel;
    private $insuranceType;
    private $insuranceCost;

    public function __construct()
    {
        $this->shippingMethodTitle = '';
        $this->insuranceType = '';
        $this->insuranceCost = 0;
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

    public function setShippingMethodTitle($shippingMethodTitle)
    {
        $this->shippingMethodTitle = $shippingMethodTitle;
    }

    public function setInsuranceType($insuranceType)
    {
        $this->insuranceType = $insuranceType;
    }

    public function setInsuranceTypeLabel($insuranceTypeLabel)
    {
        $this->insuranceTypeLabel = $insuranceTypeLabel;
    }

    public function setInsuranceCost($insuranceCost)
    {
        $this->insuranceCost = $insuranceCost;
    }
}
