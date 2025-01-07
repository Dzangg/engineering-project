<?php

namespace App\Controller;

use App\Entity\Gesture;
use App\Repository\CategoryRepository;
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
                'gestures' => $category->getGestures()->map(function($gesture) {
                    /** @var Gesture $gesture */
                    return [
                        'id' => $gesture->getId(),
                        'label' => $gesture->getLabel(),
                        'videoPath' => $gesture->getVideoPath(),
                    ];
                })->toArray()
            ];
        }, $categories);

        return $this->render('dashboard/dashboard.html.twig', [
            'controller_name' => 'DashboardController',
            'categories' => $categories
        ]);
    }
}
