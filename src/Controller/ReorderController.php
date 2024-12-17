<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReorderController extends AbstractController
{
    #[Route('/reorder', name: 'app_reorder')]
    public function index(): Response
    {
        return $this->render('reorder/reorder.html.twig', [
            'controller_name' => 'ReorderController',
        ]);
    }
}
