<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CalculadoraController extends AbstractController {

    /** 
    * @Route ("/suma/{num1}/{num2}", name="calc_suma", requirements={"num1"="\d+", "num2"="\d+"})
    */
    public function suma(int $num1 = 0, int $num2 = 0): Response
    {
        // return new Response("<body>El resultado de sumar ".$num1." + ".$num2." es ".($num1+$num2)."</body>");
        return $this->render('calc.html.twig', [
            'titulo' => "Suma",
            'operacionLarga' => "sumar",
            'operacionSimbolo' => "+",
            'num1' => $num1,
            'num2' => $num2,
            'resultado' => ($num1+$num2)
        ]);
    }

    /** 
    * @Route ("/resta/{num1}/{num2}", name="calc_resta", requirements={"num1"="\d+", "num2"="\d+"})
    */
    public function resta(int $num1 = 0, int $num2 = 0): Response
    {
        // return new Response("<body>El resultado de restar ".$num1." - ".$num2." es ".($num1-$num2)."</body>");
        return $this->render('calc.html.twig', [
            'titulo' => "Resta",
            'operacionLarga' => "restar",
            'operacionSimbolo' => "-",
            'num1' => $num1,
            'num2' => $num2,
            'resultado' => ($num1-$num2)
        ]);
    }

    /** 
    * @Route ("/multi/{num1}/{num2}", name="calc_multi", requirements={"num1"="\d+", "num2"="\d+"})
    */
    public function multi(int $num1 = 1, int $num2 = 1): Response
    {
        // return new Response("<body>El resultado de multiplicar ".$num1." &times; ".$num2." es ".($num1*$num2)."</body>");
        return $this->render('calc.html.twig', [
            'titulo' => "Multiplicación",
            'operacionLarga' => "multiplicar",
            'operacionSimbolo' => "×",
            'num1' => $num1,
            'num2' => $num2,
            'resultado' => ($num1*$num2)
        ]);
    }

    /** 
    * @Route ("/divi/{num1}/{num2}", name="calc_divi", requirements={"num1"="\d+", "num2"="\d+"})
    */
    public function divi(int $num1 = 1, int $num2 = 1): Response
    {
        // return new Response("<body>El resultado de dividir ".$num1." / ".$num2." es ".($num1/$num2)." con resto ".($num1%$num2)."</body>");
        return $this->render('calc.html.twig', [
            'titulo' => "División",
            'operacionLarga' => "dividir",
            'operacionSimbolo' => "/",
            'num1' => $num1,
            'num2' => $num2,
            'resultado' => ($num1/$num2)
        ]);
    }

}