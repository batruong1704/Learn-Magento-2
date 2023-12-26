<?php
namespace Magento\HelloWorld\Observer;

class Test implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $displayText = $observer->getData('mp_text');
        echo $displayText->getText() . " - Event </br>";
        $displayText->setText('</br> => Success.');

        echo $observer->getEvent()->getData('mp_test');
        echo $observer->getEvent()->getSql();
        return $this;
    }
}
