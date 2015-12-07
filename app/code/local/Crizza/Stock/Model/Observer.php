<?php

class Crizza_Stock_Model_Observer
{

    /**
     * Check who triggered the current event
     * @return int
     */
    protected function checkTigger()
    {
        if (Mage::getSingleton('api/server')->getAdapter()) {
            return Crizza_Stock_Model_Variation::TRIGGER_API;
        } else if (Mage::getSingleton('admin/session')->isLoggedIn()) {
            return Crizza_Stock_Model_Variation::TRIGGER_ADMIN;
        } else {
            return Crizza_Stock_Model_Variation::TRIGGER_PURCHASE;
        }
    }

    /**
     * This function is called when something change the inventory
     *
     * @param Varien_Event_Observer $observer
     */
    public function catalogInventorySave(Varien_Event_Observer $observer)
    {
        try {
            $event = $observer->getEvent();
            $item = $event->getItem();

            if (empty($item->getQtyCorrection()))
            {
                return;
            }

            $product = Mage::getModel("catalog/product")->load($item->getProductId());

            $model = Mage::getModel(Crizza_Stock_Model_Variation::ENTITY_MODEL)
                ->setProductSku($product->getSku())
                ->setQtyLast($item->getOriginalInventoryQty())
                ->setQtyVariation($item->getQtyCorrection())
                ->setQtyCurrent($item->getQty())
                ->setTriggered($this->checkTigger());

            $model->save();
        } catch (Exception $ex) {

            Mage::log(__METHOD__ . " - " . $ex->getMessage(), null, "crizza_stock.log");

        }

    }

    /**
     * This function an item is purchased
     *
     * @param Varien_Event_Observer $observer
     */
    public function subtractQuoteInventory(Varien_Event_Observer $observer)
    {
        try {
            $quote = $observer->getEvent()->getQuote();

            /** @var Mage_Sales_Model_Quote_Item $item */
            foreach ($quote->getAllItems() as $item) {

                $model = Mage::getModel(Crizza_Stock_Model_Variation::ENTITY_MODEL)
                    ->setProductSku($item->getSku())
                    ->setQtyLast($item->getProduct()->getStockItem()->getQty())
                    ->setQtyVariation($item->getTotalQty() * -1)
                    ->setQtyCurrent($item->getProduct()->getStockItem()->getQty() - $item->getTotalQty())
                    ->setTriggered($this->checkTigger());

                $model->save();
            }
        } catch (Exception $ex) {

            Mage::log(__METHOD__ . " - " . $ex->getMessage(), null, "crizza_stock.log");

        }

    }

    /**
     * This function is called when magento has an error with the current Quote
     *
     * @param Varien_Event_Observer $observer
     */
    public function revertQuoteInventory(Varien_Event_Observer $observer)
    {
        try {
            $quote = $observer->getEvent()->getQuote();

            /** @var Mage_Sales_Model_Quote_Item $item */
            foreach ($quote->getAllItems() as $item) {

                $model = Mage::getModel(Crizza_Stock_Model_Variation::ENTITY_MODEL)
                    ->setProductSku($item->getSku())
                    ->setQtyLast($item->getProduct()->getStockItem()->getQty())
                    ->setQtyVariation($item->getTotalQty())
                    ->setQtyCurrent($item->getProduct()->getStockItem()->getQty() + $item->getTotalQty())
                    ->setTriggered($this->checkTigger());

                $model->save();
            }
        } catch (Exception $ex) {

            Mage::log(__METHOD__ . " - " . $ex->getMessage(), null, "crizza_stock.log");

        }
    }

    /**
     * This function is called when magento try delete an order
     *
     * @param Varien_Event_Observer $observer
     */
    public function cancelOrderItem(Varien_Event_Observer $observer)
    {
        $item = $observer->getEvent()->getItem();
        $qty = $item->getQtyOrdered() - max($item->getQtyShipped(), $item->getQtyInvoiced()) - $item->getQtyCanceled();

        $model = Mage::getModel(Crizza_Stock_Model_Variation::ENTITY_MODEL)
            ->setProductSku($item->getProduct()->getSku())
            ->setQtyLast($item->getProduct()->getStockItem()->getQty() - $qty)
            ->setQtyVariation($qty)
            ->setQtyCurrent($item->getProduct()->getStockItem()->getQty())
            ->setTriggered($this->checkTigger());

        $model->save();
    }

    /**
     * This function is called when magento try make a refund an order
     *
     * @param Varien_Event_Observer $observer
     */
    function refundOrderInventory(Varien_Event_Observer $observer)
    {
       try {

            /** @var Mage_Sales_Model_Order_Creditmemo $creditmemo */
            $creditmemo = $observer->getEvent()->getCreditmemo();

            /** @var Mage_Sales_Model_Order_Creditmemo_Item $item */
            foreach ($creditmemo->getAllItems() as $item) {

                $product = Mage::getModel("catalog/product")->load($item->getProductId());
                $model = Mage::getModel(Crizza_Stock_Model_Variation::ENTITY_MODEL)
                    ->setProductSku($item->getSku())
                    ->setQtyLast($product->getStockItem()->getQty() - $item->getQty())
                    ->setQtyVariation($item->getQty())
                    ->setQtyCurrent($product->getStockItem()->getQty())
                    ->setTriggered($this->checkTigger());

                $model->save();
            }
        } catch (Exception $ex) {

            Mage::log(__METHOD__ . " - " . $ex->getMessage(), null, "crizza_stock.log");
        }
    }
}