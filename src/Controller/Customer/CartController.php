<?php 

namespace App\Controller\Customer;

use App\Services\CartService;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }


    #[Route('/panier/ajouter/{id}', name: 'cart_add')]
    public function add(int $id,ProductRepository $productRepository, Request $request)
    {
        $product = $productRepository->find($id);

        if(!$product)
        {
            $this->addFlash("danger","Le produit est introuvable");
            return $this->redirectToRoute("home");
        }

        $this->cartService->add($id);

        $this->addFlash("success","Le produit a été ajouté !");

        if($request->query->get('returnToCart'))
        {
            return $this->redirectToRoute("cart_detail");
        }

        return $this->redirectToRoute("cart_detail");
        
    }

    #[Route('/panier/detail', name: 'cart_detail')]
    public function detail()
    {
        $cart = $this->cartService->detail();

        $totalCart = $this->cartService->getTotal();

        return $this->render("customer_product/panier/detail.html.twig",[
            'cart' => $cart,
            'totalCart' => $totalCart
        ]);
    }

    #[Route('/panier/supprimer/{id}', name: 'cart_remove')]
    public function delete(int $id,ProductRepository $productRepository)
    {
        $product = $productRepository->find($id);

        if(!$product)
        {
            $this->addFlash("danger","Produit introuvable");
            return $this->redirectToRoute("cart_detail");
        } 

        $this->cartService->remove($id);

        $this->addFlash("success","Le produit a bien été supprimé");
        return $this->redirectToRoute("cart_detail");
    }

    #[Route('/panier/decrementer/{id}', name: 'cart_decrement')]
    public function decrementProduct(int $id,ProductRepository $productRepository)
    {
        $product = $productRepository->find($id);

        if(!$product)
        {
             $this->addFlash("danger","Le produit est introuvable.");
             return $this->redirectToRoute("cart_detail");
        }

        $this->cartService->decrement($id);

        $this->addFlash("success","Vous avez bien soustrait le produit.");
        return $this->redirectToRoute("cart_detail");
    }
}