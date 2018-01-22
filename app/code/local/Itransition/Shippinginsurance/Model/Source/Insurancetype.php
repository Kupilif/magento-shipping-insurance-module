<?php

class Itransition_Shippinginsurance_Model_Source_InsuranceType
{
    const FIXED_VALUE_TYPE = '0';
    const PERCENT_VALUE_TYPE = '1';
    const FIXED_VALUE_TYPE_LABEL = 'Fixed value';
    const PERCENT_VALUE_TYPE_LABEL = 'Percent from cost';

    public function toOptionArray()
    {
        return array(
            array(
                'value' => self::FIXED_VALUE_TYPE,
                'label' => Mage::helper('shippinginsurance')->__(self::FIXED_VALUE_TYPE_LABEL)
            ),
            array(
                'value' => self::PERCENT_VALUE_TYPE,
                'label' => Mage::helper('shippinginsurance')->__(self::PERCENT_VALUE_TYPE_LABEL)
            )
        );
    }

    public function toArray()
    {
        return array(
            self::FIXED_VALUE_TYPE => Mage::helper('shippinginsurance')->__(self::FIXED_VALUE_TYPE_LABEL),
            self::PERCENT_VALUE_TYPE => Mage::helper('shippinginsurance')->__(self::PERCENT_VALUE_TYPE_LABEL)
        );
    }
}
