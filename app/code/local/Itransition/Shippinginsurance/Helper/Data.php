<?php

class Itransition_Shippinginsurance_Helper_Data extends Mage_Core_Helper_Abstract
{
    const INSURANCE_ENABLED_CONFIG_PATH = 'shippinginsurance/general/enabled';
    const CONFIGURATION_SECTION = 'shippinginsurance/';
    const INSURANCE_ENABLED_FOR_SHIPPING_METHOD_FIELD = '/enabled';
    const INSURANCE_VALUE_FIELD = '/value';
    const INSURANCE_TYPE_FIELD = '/type';
    const FIXED_COST_LABEL = 'Fixed cost';
    const PERCENT_FROM_COST_LABEL = '% from cost';
    const INSURANCE_ROW_LABEL = 'Insurance';
    const ENABLED = '1';
    const DISABLED = '0';
    const _100_PERCENTS = 100;

    public function isInsuranceModuleEnabled()
    {
        return Mage::getStoreConfig(self::INSURANCE_ENABLED_CONFIG_PATH) === self::ENABLED;
    }

    public function isInsuranceEnabledForShippingMethod($shippingCode)
    {
        $value = Mage::getStoreConfig(self::CONFIGURATION_SECTION .
            $shippingCode . self::INSURANCE_ENABLED_FOR_SHIPPING_METHOD_FIELD);
        return $value === self::ENABLED;
    }

    public function getInsuranceValueForShippingMethod($shippingCode)
    {
        return Mage::getStoreConfig(self::CONFIGURATION_SECTION .
            $shippingCode . self::INSURANCE_VALUE_FIELD);
    }

    public function getInsuranceTypeForShippingMethod($shippingCode)
    {
        return Mage::getStoreConfig(self::CONFIGURATION_SECTION .
            $shippingCode . self::INSURANCE_TYPE_FIELD);
    }

    public function getShippingMethodTitle($shippingCode)
    {
        return Mage::getStoreConfig('carriers/' . $shippingCode . '/title');
    }

    public function calculateInsurance($shippingCode, $subtotal)
    {
        $result = new Itransition_Shippinginsurance_Model_InsuranceInfo();
        $insuranceTypeModel = Mage::getModel('shippinginsurance/source_insurancetype');
        $insuranceValue = $this->getInsuranceValueForShippingMethod($shippingCode);
        $insuranceType = $this->getInsuranceTypeForShippingMethod($shippingCode);

        switch ($insuranceType) {
            case $insuranceTypeModel::FIXED_VALUE_TYPE:
                $result->setInsuranceCost((double)$insuranceValue);
                $result->setInsuranceTypeLabel(self::FIXED_COST_LABEL);
                break;
            case $insuranceTypeModel::PERCENT_VALUE_TYPE:
                $result->setInsuranceCost(
                    $subtotal * $insuranceValue / self::_100_PERCENTS
                );
                $result->setInsuranceTypeLabel(
                    $insuranceValue . self::PERCENT_FROM_COST_LABEL
                );
                break;
        }

        $result->setInsuranceType($insuranceType);
        $result->setShippingMethodTitle($this->getShippingMethodTitle($shippingCode));
        return $result;
    }

    public function updateInsuranceCost($shippingCode, $quote)
    {
        if (($this->isInsuranceModuleEnabled()) &&
                ($this->isInsuranceEnabledForShippingMethod($shippingCode))) {
            $insuranceInfo = $this->calculateInsurance($shippingCode, $quote->getSubtotal());
            $quote->setInsurance($insuranceInfo->getInsuranceCost());
        } else {
            $quote->setInsurance(null);
        }
    }

    public function addInsuranceRowToTotals($block)
    {
        $insuranceCost = $block->getOrder()->getInsurance();

        if ($this->isNecessaryToAddInsuranceToGrandTotal($insuranceCost)) {
            $block->addTotal(new Varien_Object(array(
                'code' => $block->getCode(),
                'value' => $insuranceCost,
                'base_value' => $insuranceCost,
                'label' => $this->__(self::INSURANCE_ROW_LABEL)
            )));
        }
    }

    public function isNecessaryToAddInsuranceToGrandTotal($insuranceCost)
    {
        return ($insuranceCost !== null);
    }

    public function getCorrectShippingMethodCode($shippingMethod)
    {
        $underscorePosition = strpos($shippingMethod, '_');

        if ($underscorePosition !== false) {
            return substr($shippingMethod, 0, $underscorePosition);
        } else {
            return $shippingMethod;
        }
    }
}
