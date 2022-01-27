<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LuckyController extends AbstractController
{
    /**
     * @Route("/lucky/number/{major}/{minor}", name="lucky_number")
     */
     public function number(int $major = 100,int $minor = 0): Response
     {
         $number = random_int($minor, $major);

         return $this->render('number.html.twig', [
             'number' => $number,
         ]);
     }

     /**
      * @Route("/phpinfo"), name="phpinfo")
      */
      public function peachepeinfo(): Response
      {
          return new Response(phpinfo());
      }
}