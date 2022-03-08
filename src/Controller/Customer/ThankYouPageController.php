<?php

namespace App\Controller\Customer;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ThankYouPageController extends AbstractController
{
    #[Route('/merci', name: 'thank_you_page')]
    public function thank()
    {
        return $this ->render("customer_product/commande/thank_you.html.twig");
    }
}

?>