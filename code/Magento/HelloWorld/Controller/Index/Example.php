<?php
namespace Magento\HelloWorld\Controller\Index;

class Example extends \Magento\Framework\App\Action\Action
{

    protected $title;

    public function execute()
    {
        echo $this->setTitle("Demo Plugin");
    }

    public function setTitle($title)
    {
        return $this->title = $title;
    }

}
