<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/freePalestine', name: 'app_freePalestine')]
    public function freePalestine()
    {
        return new Response("#FreeFreePalestine");

    }
#[Route('/free', name: 'app_free')]
    public function free()
    {
        $name="Gaza";
        return new Response("#Free".$name);

    }
#[Route('/free2/{name}', name: 'app_free2')]
    public function free2($name)
    {

        return new Response("#Free".$name);

    }
#[Route('/calcul', name: 'app_calcul')]
public function calcul(){
$nbr=1500;
return $this->render("home/calcul.html.twig",
array("number"=>$nbr));
}

}

