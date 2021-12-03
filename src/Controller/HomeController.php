<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request): Response
        {

            $params =$request->query->get('uuid');
            $params2 =$request->query->get('campaign_name');
            if ($params === null || $params === ""){
                return $this->redirect('https://zooger.space/default7?n=sinatragoldensands');
            }else{
                return $this->redirect('https://zooger.space/default7?n=sinatragoldensands&uid='.$params);
            }
/*
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
*/
        }


}
