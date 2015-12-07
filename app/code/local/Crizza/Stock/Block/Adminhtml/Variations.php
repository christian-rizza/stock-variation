<?php

class Crizza_Stock_Block_Adminhtml_Variations extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct()
    {
        $this->_blockGroup = "crizza_stock";
        $this->_controller = "adminhtml_variations";
        $this->_headerText = $this->__('Variations List');
        parent::__construct();
        $this->_removeButton('add');
    }
}
