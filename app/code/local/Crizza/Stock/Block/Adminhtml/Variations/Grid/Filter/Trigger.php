<?php

class Crizza_Stock_Block_Adminhtml_Variations_Grid_Filter_Trigger extends Mage_Adminhtml_Block_Widget_Grid_Column_Filter_Select
{

    protected $_triggers;

    public function __construct()
    {
        $this->_triggers = array(
            null                                            => null,
            Crizza_Stock_Model_Variation::TRIGGER_ADMIN     => $this->__('Admin'),
            Crizza_Stock_Model_Variation::TRIGGER_API       => $this->__('Api'),
            Crizza_Stock_Model_Variation::TRIGGER_PURCHASE  => $this->__('Purchase'),
        );
        parent::__construct();
    }

    protected function _getOptions()
    {
        $result = array();
        foreach ($this->_triggers as $code=>$label) {
            $result[] = array('value'=>$code, 'label'=>$this->__($label));
        }

        return $result;
    }

}
