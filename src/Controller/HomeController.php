<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/home')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('index.html.twig', []);
    }
    // home/jorge
    #[Route('/{name}', name: 'app_homepresonalizada_index', methods: ['GET'])]
    public function indexpersonalizada(Request $request): Response
    {
        //dump($request->attributes->get('name'));die;
        // En el caso de que sea un parámetro: $name = $request->query->get('name');
        return $this->render('index.html.twig', [
            'name' => $request->attributes->get('name'),
        ]);
    }
}
