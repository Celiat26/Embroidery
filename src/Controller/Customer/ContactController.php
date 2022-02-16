<?php

namespace App\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/prendrecontact', name: 'contact')]
    public function index(): Response
    {
        return $this->render('customer/contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
