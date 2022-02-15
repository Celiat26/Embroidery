<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerProductController extends AbstractController
{
    #[Route('/customer/category/{id}', name: 'customer_category')]
    public function index($id, CategoryRepository $categoryRepository): Response
    {
        
        $category = $categoryRepository->find($id);

        if(!$category)
        {
            return $this->redirectToRoute("home");
        }

        return $this->render('customer_product/category.html.twig', [
            'category' => $category
        ]);
    }

    #[Route('/customer/product/{id}', name: 'customer_product')]
    public function showProduct($id, ProductRepository $productRepository): Response
    {
        $product = $productRepository->find($id);

        if(!$product)
        {
            return $this->redirectToRoute("home");
        }

        return $this->render('customer_product/product.html.twig',[
            'product' => $product
        ]);
    }


}
