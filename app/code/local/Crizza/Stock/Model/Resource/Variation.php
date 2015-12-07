<?php

class Crizza_Stock_Model_Resource_Variation extends Mage_Eav_Model_Entity_Abstract
{
    public function _construct()
    {
        $resource = Mage::getSingleton('core/resource');
        $this->setType(Crizza_Stock_Model_Variation::ENTITY_CODE);
        $this->setConnection(
            $resource->getConnection('crizza_stock_read'),
            $resource->getConnection('crizza_stock_write')
        );
    }
}