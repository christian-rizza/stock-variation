<?php

class Crizza_Stock_Model_Resource_Variation_Collection extends Mage_Catalog_Model_Resource_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init(Crizza_Stock_Model_Variation::ENTITY_MODEL);
    }

}