<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
   /**
   * @Route("/{vueRouting}", name="index")
   * @return Response
   */
    public function indexAction(): Response
    {
        return $this->render('base.html.twig', []);
    }
    /**
    * @Route("/", name="default")
    * @return Response
    */
  public function default(): Response
  {
      return $this->render('base.html.twig', []);
  }
  
}
