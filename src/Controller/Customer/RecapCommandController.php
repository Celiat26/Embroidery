<?php

namespace App\Controller\Customer;


use App\Entity\User;
use App\Entity\CommandShop;
use App\Services\CartService;
use App\Entity\CommandShopLine;
use App\Entity\DeliveryAddress;
use App\Form\DeliveryAdressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecapCommandController extends AbstractController
{
    #[Route('/commande/recapitulatif', name: 'command_recap')]
    public function recap(Request $request, EntityManagerInterface $em, CartService $cartService)
    {
        $deliveryAddress = new DeliveryAddress();

        $form = $this -> createForm(DeliveryAdressType::class, $deliveryAddress);
        
        $form->handleRequest($request);

        $cart = $cartService->detail();

        $totalCart = $cartService->getTotal();

        /** @var User $user */
        $user = $this -> getUser();
       
        if($form->isSubmitted() && $form->isValid())
        {
            $commandShop = new CommandShop();
            $commandShop -> setUser($user);
            $commandShop -> setTotalPrice($totalCart);
            $em -> persist($commandShop);

            foreach($cart as $item)
            {
                $commandShopLine = new CommandShopLine();
                $commandShopLine -> setCommandShop($commandShop);
                $commandShopLine -> setProduct($item -> getProduct());
                $commandShopLine -> setQuantity($item -> getQty());
                $em -> persist($commandShopLine);
            }

            $deliveryAddress -> setCommandShop($commandShop);
            $em -> persist($deliveryAddress);

            $em -> flush();

            return $this -> redirectToRoute('stripe_checkout');
        }

        return $this->render("customer_product/commande/recap.html.twig", [
            'form' => $form->createView(),
            'cart' => $cart,
            'totalCart' => $totalCart
        ]);
    }
}

?>