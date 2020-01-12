<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\User\ChangeUserPasswordType;
use App\Form\User\Dto\ChangeUserPasswordDTO;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountMeController extends AbstractController
{
    /**
     * @Route("/account/me", name="app_account_me")
     */
    public function index()
    {
        $user = $this->getUser();
        $changeUserPasswordDTO = new ChangeUserPasswordDTO();

        $form = $this->createForm(ChangeUserPasswordType::class, $changeUserPasswordDTO);

        return $this->render('account_me/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/account/me/change-password", name="app_account_change_password", methods={"GET","POST"})
     */
    public function changePassword(Request $request, UserService $userService): Response
    {
        $user = $this->getUser();
        $changeUserPasswordDTO = new ChangeUserPasswordDTO();
        $form = $this->createForm(ChangeUserPasswordType::class, $changeUserPasswordDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $changeUserPasswordDTO->id = $user->getId();
            $userService->changePassword($changeUserPasswordDTO);

            return $this->redirectToRoute('app_account_me');
        }

        return $this->render('account_me/change-password.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
