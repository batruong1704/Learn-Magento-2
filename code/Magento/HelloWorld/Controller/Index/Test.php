<?php
namespace Magento\HelloWorld\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{
//    protected $_pageFactory;
//
//    public function __construct(
//        \Magento\Framework\App\Action\Context $context,
//        \Magento\Framework\View\Result\PageFactory $pageFactory)
//    {
//        $this->_pageFactory = $pageFactory;
//        parent::__construct($context);
//    }

    public function execute()
    {
        $textDisplay = new \Magento\Framework\DataObject(array('text' => 'Mageplaza'));
        $this->_eventManager->dispatch('mageplaza_helloworld_display_text', [
            'mp_text' => $textDisplay,
            'sql' => "Con so gi day ?"
        ]);
        echo $textDisplay->getText();
        exit;
    }
}
