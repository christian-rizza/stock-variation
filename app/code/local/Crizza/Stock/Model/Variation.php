<?php

class Crizza_Stock_Model_Variation extends Mage_Core_Model_Abstract {


    const ENTITY_MODEL  = "crizza_stock/variation";
    const ENTITY_TABLE  = "crizza_stock/variation_entity";
    const ENTITY_CODE   = "crizza_stock_variation";


    const TRIGGER_ADMIN     = 1;
    const TRIGGER_PURCHASE  = 2;
    const TRIGGER_API       = 3;

    public function __construct()
    {
        $this->_init(self::ENTITY_MODEL);
    }
}