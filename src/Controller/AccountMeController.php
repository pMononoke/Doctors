<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountMeController extends AbstractController
{
    /**
     * @Route("/account/me", name="app_account_me")
     */
    public function index()
    {
        $user = $this->getUser();

        return $this->render('account_me/index.html.twig', [
            'user' => $user,
        ]);
    }
}
