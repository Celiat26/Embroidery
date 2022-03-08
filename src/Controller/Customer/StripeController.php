<?php 

namespace App\Controller\Customer;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Services\CartService;
use App\Services\CartRealProduct;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeController extends AbstractController
{
    #[Route('/stripe/checkout', name: 'stripe_checkout')]
    public function createSession(CartService $cartService)
    {
        Stripe::setApiKey('sk_test_51IBjOmJxItuCvN48kVDdR9Tg52Npf4IJydX0TFxyioJFxo5vdlObzoYYTmiVZ2BD2XqGQkvsWaj8UNNzEz3ekgMo00jPcW004c');

        $domain = 'http://localhost:8000';

        /** @var CartRealProduct[] $detailCart */
        $detailCart = $cartService->detail();

        $productForStripe = [];

        /** @var User $user */
        $user = $this->getUser();

        foreach($detailCart as $item)
        {
            $productForStripe[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $item->getProduct()->getPrix(),
                    'product_data' => [
                        'name' => $item->getProduct()->getName(),
                        'images' => [
                            $domain . $item->getProduct()->getImage()
                        ]
                    ]
                ],
                'quantity' => $item->getQty()
            ];
        }

        $checkout_session = Session::create([
            'customer_email' => $user->getEmail(),
            'payment_method_types' => [
                'card',
            ],
            'line_items' => [
                $productForStripe
            ],
            'mode' => 'payment',
              'success_url' => $domain . '/paiementreussi',
              'cancel_url' => $domain . '/paiementechoue',
          ]);

          return $this->redirect($checkout_session->url);
    }
}