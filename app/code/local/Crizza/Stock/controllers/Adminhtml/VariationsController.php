<?php

class Crizza_Stock_Adminhtml_VariationsController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_setTitle($this->__('Stock Variations'))->_setTitle($this->__('Variation List'));
        $this->_initAction()->renderLayout();
    }
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('catalog/variations')
            ->_addBreadcrumb($this->__('Stock Variation'), $this->__('Stock Variations'));

        return $this;
    }

    protected function _setTitle($title)
    {
        $this->_title($title);
        return $this;
    }


}