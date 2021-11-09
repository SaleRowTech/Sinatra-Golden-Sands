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

//        $params =$request->query->get('uuid');
//        $params2 =$request->query->get('campaign_name');
//        //var_dump($request->query->get('uuid'));
//        if ($params === "" || $params === null){
//            return $this->redirect('https://zooger.space/HdL7Ny?n=flirtme');
////            echo $params;
////            echo "<br>";
////            echo $params2;
////            die;
//        }else{
//            return $this->redirect('https://zooger.space/HdL7Ny?n=flirtme&uid='.$params);
////            echo $params;
////            echo "<br>";
////            echo $params2;
////            die;
//        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }



}
