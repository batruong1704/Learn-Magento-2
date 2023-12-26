<?php

namespace Magento\HelloWorld\Plugin;

class ExamplePlugin
{

    public function beforeSetTitle(\Magento\HelloWorld\Controller\Index\Example $subject, $title)
    {
        $title = $title . " to ";

        echo __METHOD__ . "</br>";

        return [$title];
    }

    public function aroundSetTitle(\Magento\HelloWorld\Controller\Index\Example $subject, callable $call, $title)
    {
        echo __METHOD__ . "before </br>";
        $title .= ' Around';
        $result = $call($title);
        echo __METHOD__ . "after </br>";
        return $result;
    }

    public function afterSetTitle(\Magento\HelloWorld\Controller\Index\Example $subject, $result)
    {
        echo "</br>". __METHOD__;
        echo $result;
        return $result;
    }

}
