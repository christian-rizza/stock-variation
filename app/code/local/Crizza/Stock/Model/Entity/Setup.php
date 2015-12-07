<?php

class Crizza_Stock_Model_Entity_Setup extends Mage_Eav_Model_Entity_Setup
{
    protected $entities = array(

        Crizza_Stock_Model_Variation::ENTITY_CODE => array(
            'entity_model'      => Crizza_Stock_Model_Variation::ENTITY_MODEL,
            'attribute_model'   => '',
            'table'             => Crizza_Stock_Model_Variation::ENTITY_TABLE,
            'attributes'        => array(
                'product_sku'   => array(
                    'type'              => 'varchar',
                    'backend'           => '',
                    'frontend'          => '',
                    'label'             => 'Product SKU',
                    'input'             => 'text',
                    'class'             => '',
                    'source'            => '',
                    'global'            => 0,
                    'visible'           => true,
                    'required'          => true,
                    'user_defined'      => true,
                    'default'           => '',
                    'searchable'        => false,
                    'filterable'        => false,
                    'comparable'        => false,
                    'visible_on_front'  => false,
                    'unique'            => false,
                ),
                'qty_last'      => array(
                    'type'              => 'int',
                    'label'             => 'Qty Last',
                    'visible'           => true,
                    'required'          => true,
                    'user_defined'      => true,
                    'searchable'        => false,
                    'filterable'        => false,
                    'comparable'        => false,
                    'visible_on_front'  => false,
                    'unique'            => false,
                ),
                'qty_variation' => array(
                    'type'              => 'int',
                    'label'             => 'Qty Variation',
                    'visible'           => true,
                    'required'          => true,
                    'user_defined'      => true,
                    'searchable'        => false,
                    'filterable'        => false,
                    'comparable'        => false,
                    'visible_on_front'  => false,
                    'unique'            => false,
                ),
                'qty_current'   => array(
                    'type'              => 'int',
                    'label'             => 'Qty Current',
                    'visible'           => true,
                    'required'          => true,
                    'user_defined'      => true,
                    'searchable'        => false,
                    'filterable'        => false,
                    'comparable'        => false,
                    'visible_on_front'  => false,
                    'unique'            => false,
                ),
                'triggered'     => array(
                    'type'              => 'int',
                    'label'             => 'Triggered By',
                    'visible'           => true,
                    'required'          => true,
                    'user_defined'      => true,
                    'searchable'        => false,
                    'filterable'        => false,
                    'comparable'        => false,
                    'visible_on_front'  => false,
                    'unique'            => false,
                ),
            ),
        )

    );

    public function getDefaultEntities()
    {
        return $this->entities;
    }
}