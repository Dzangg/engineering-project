<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\GestureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAllWithGestures();

        $categories = array_map(function($category) {
            return [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'gestures' => array_map(function($gesture) {
                    return [
                        'id' => $gesture->getId(),
                        'label' => $gesture->getLabel(),
                    ];
                }, $category->getGestures()->toArray())
            ];
        }, $categories);

        return $this->render('dashboard/dashboard.html.twig', [
            'controller_name' => 'DashboardController',
            'categories' => $categories
        ]);
    }
}
