<?php

namespace App\UI\REST\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function home()
    {
        return $this->json('Hello on cinema reservation system ;)');
    }
}