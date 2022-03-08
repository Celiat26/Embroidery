<?php 

namespace App\Controller\Customer;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommandShopRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SuccessCommandShopController extends AbstractController
{
    #[Route('/paiementreussi', name: 'stripe_success_payment')]
    public function success(EntityManagerInterface $em, CommandShopRepository $commandShopRepository)
    {
        /** @var User $user */
        $user = $this->getUser();

        $commandShop = $commandShopRepository->findOneBy([
            'user' => $user
        ],[
            'id' => 'DESC'
        ]);

        $commandShop->setIsPayed(true);

        $em->flush();

        return $this->redirectToRoute("thank_you_page");
    }

    #[Route('/paiementechoue', name: 'stripe_cancel_payment')]
    public function cancel()
    {
        $this->addFlash("info","Votre paiment a échoué");
        return $this->redirectToRoute("cart_detail");
    }
}