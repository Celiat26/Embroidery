<?php

namespace App\Controller\Customer;

use App\Search\SearchProduct;
use App\Form\SearchProductType;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(CategoryRepository $categoryRepository, ProductRepository $productRepository, Request $request): Response
    {

        $search = new SearchProduct();

        $form = $this->createForm(SearchProductType::class,$search);

        $form->handleRequest($request);

        $products = $productRepository->findByFilter($search);
        
        // $products = $productRepository->findBy([],[
        //     'id' => 'DESC'
        // ],
        // 6);

        return $this->render('home/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'products' => $products,
            'form' => $form->createView()
        ]);
    }
}
