<?php
namespace MediaLounge\Storyblok\Controller\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\Action;
use MediaLounge\Storyblok\Block\Container;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Ajax extends Action implements HttpPostActionInterface
{
    public function __construct(Context $context, JsonFactory $resultJsonFactory)
    {
        parent::__construct($context);

        $this->resultJsonFactory = $resultJsonFactory;
    }

    public function execute(): ResultInterface
    {
        $story = $this->getRequest()->getParam('story', null);

        $result = $this->resultJsonFactory->create();

        $block = $this->_view
            ->getLayout()
            ->createBlock(Container::class)
            ->setStory($story)
            ->toHtml();

        return $result->setData([$story['content']['_uid'] => $block]);
    }
}