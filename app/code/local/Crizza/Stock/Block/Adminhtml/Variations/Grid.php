<?php
class Crizza_Stock_Block_Adminhtml_Variations_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel(Crizza_Stock_Model_Variation::ENTITY_MODEL)->getCollection()->addAttributeToSelect('*');
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header' => $this->__("ID"),
            'width' => '50px',
            'index' => 'entity_id',
            'filter' => false,
        ));

        $this->addColumn('product_sku', array(
            'header'    =>  $this->__("Product SKU"),
            'index'     =>  'product_sku',
        ));

        $this->addColumn('qty_last', array(
            'header'    =>  $this->__("Qty Last"),
            'index'     =>  'qty_last',
            'filter' => false,
        ));

        $this->addColumn('qty_current', array(
            'header'    =>  $this->__("Qty Current"),
            'index'     =>  'qty_current',
            'filter' => false,
        ));

        $this->addColumn('qty_variation', array(
            'header'    =>  $this->__("Qty Variation"),
            'index'     =>  'qty_variation',
            'filter' => false,
        ));

        $this->addColumn('triggered', array(
            'header'    =>  $this->__("Triggerd by"),
            'index'     =>  'triggered',
            'filter'    =>  'crizza_stock/adminhtml_variations_grid_filter_trigger',
            'renderer'  =>  'crizza_stock/adminhtml_variations_grid_renderer_trigger',
        ));

        $this->addColumn('created_at', array(
            'header'    =>  $this->__("Create On"),
            'align'         => 'left',
            'type'          => 'datetime',
            'index'     =>  'created_at',
            'filter' => false,
        ));

        return parent::_prepareColumns();
    }


}