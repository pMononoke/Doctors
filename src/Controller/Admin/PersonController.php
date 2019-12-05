<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonController extends AbstractController
{
    /**
     * @Route("/admin/person", name="admin_person")
     */
    public function index(): Response
    {
        return $this->render('admin/person/index.html.twig', [
            'controller_name' => 'PersonController',
        ]);
    }
}
