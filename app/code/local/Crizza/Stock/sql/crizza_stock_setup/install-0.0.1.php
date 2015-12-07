<?php

Mage::log(get_class($this)." - Installing Module...");

/** @var Crizza_Stock_Model_Entity_Setup $installer */
$installer = $this;
$installer->startSetup();

try {

    $table = $this->getTable(Crizza_Stock_Model_Variation::ENTITY_TABLE);
    $table = strtolower(substr($table, strlen(Mage::getConfig()->getTablePrefix())));

    $installer->createEntityTables($table);

    $installer->addEntityType(Crizza_Stock_Model_Variation::ENTITY_CODE, array(

        'entity_model' => Crizza_Stock_Model_Variation::ENTITY_MODEL,
        'attribute_model' => '',
        'table' => Crizza_Stock_Model_Variation::ENTITY_TABLE,
        'increment_model' => '',
        'increment_per_store' => '0'

    ));

    $installer->installEntities();
    $installer->endSetup();

} catch (Exception $ex) {
    Mage::log(get_class($this)." - ".$ex->getMessage());
    die;
}


