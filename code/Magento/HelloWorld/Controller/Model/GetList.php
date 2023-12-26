<?php
namespace Magento\HelloWorld\Controller\Model;

use Magento\Framework\App\Action\Context;

class GetList extends \Magento\Framework\App\Action\Action
{
    protected $_postFactory;

    public function __construct(
        Context $context,
        \Magento\HelloWorld\Model\PostFactory $postFactory
    )
    {
        $this->_postFactory = $postFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $post = $this->_postFactory->create();
       // $post->getResource()->abcd()''
        $post->load(2);
                echo "<pre>";
        print_r($post->getData());
        echo "</pre>";
        $collection = $post->getCollection();
        echo get_class($collection);

//        echo $collection->abcd();
        echo $collection->getSelect()->__toString();
        echo "<pre>";
        print_r($collection->getData());
        echo "</pre>";

    }
}
