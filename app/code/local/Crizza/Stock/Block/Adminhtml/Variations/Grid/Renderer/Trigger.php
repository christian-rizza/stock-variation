<?php

class Crizza_Stock_Block_Adminhtml_Variations_Grid_Renderer_Trigger extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    protected $_triggers;

    public function __construct()
    {
        $this->_triggers = array(
            Crizza_Stock_Model_Variation::TRIGGER_ADMIN => $this->__('Admin'),
            Crizza_Stock_Model_Variation::TRIGGER_API => $this->__('Api'),
            Crizza_Stock_Model_Variation::TRIGGER_PURCHASE => $this->__('Purchase'),
        );
        parent::__construct();
    }

    public function render(Varien_Object $row)
    {
        return $this->__($this->getTrigger($row->getTriggered()));
    }

    public function getTrigger($trigger)
    {
        if (isset($this->_triggers[$trigger])) {
            return $this->_triggers[$trigger];
        }

        return $this->__('Unknown');
    }

}
