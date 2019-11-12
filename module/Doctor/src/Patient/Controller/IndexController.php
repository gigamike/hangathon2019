<?php

namespace Patient\Controller;

use Zend\Db\Adapter\Adapter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Gumlet\ImageResize;
use Web3\Web3;
use Web3\Utils;

class IndexController extends AbstractActionController
{
  public function indexAction()
  {
    return new ViewModel([
    ]);
  }
}
