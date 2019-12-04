<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/logout", name="app_security_logout")
     */
    public function logout()
    {
        // logout method in SecurityController can be blank: it will never be executed!
        throw new \Exception('Bye bye');
    }
}
