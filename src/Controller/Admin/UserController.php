<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\User\Dto\UserDTO;
use App\Form\User\RegisterUserType;
use App\Form\User\UserType;
use App\Repository\UserRepository;
use App\Service\UserService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="admin_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_user_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserService $userService): Response
    {
        $user = new UserDTO();
        $form = $this->createForm(RegisterUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userService->registerUserByAdminWithDtoData($user);
            $this->addFlash(
                'success',
                'flash.user.was.created'
            );

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_user_show", methods={"GET"})
     * @Entity("user", expr="repository.findByUuidString(id)")
     */
    public function show(User $user): Response
    {
        return $this->render('admin/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_user_edit", methods={"GET","POST"})
     * @Entity("user", expr="repository.findByUuidString(id)")
     */
    public function edit(Request $request, User $user, UserService $userService): Response
    {
        $userDTO = UserDTO::fromUser($user);
        $form = $this->createForm(UserType::class, $userDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setEmail($userDTO->email);
            $user->setFirstName($userDTO->firstName);
            $user->setLastName($userDTO->lastName);
            $user->setAccountStatus($userDTO->accountStatus);
            $userService->update($user);
            $this->addFlash(
                'success',
                'flash.user.changes.was.saved'
            );

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_user_delete", methods={"DELETE"})
     * @Entity("user", expr="repository.findByUuidString(id)")
     */
    public function delete(Request $request, User $user, UserService $userService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userService->delete($user);
            $this->addFlash(
                'success',
                'flash.user.was.deleted'
            );
        }

        return $this->redirectToRoute('admin_user_index');
    }

    /**
     * @Route("/{id}/enable-account", name="admin_user_enable_account", methods={"POST"})
     * @Entity("user", expr="repository.findByUuidString(id)")
     */
    public function enableAccount(Request $request, User $user, UserService $userService): Response
    {
        if ($this->isCsrfTokenValid('enableAccount'.$user->getId(), $request->request->get('_token'))) {
            $userService->enableAccount($user->getId());
            $this->addFlash(
                'success',
                'flash.user.was.enabled'
            );
        }

        return $this->redirectToRoute('admin_user_index');
    }

    /**
     * @Route("/{id}/disable-account", name="admin_user_disable_account", methods={"POST"})
     * @Entity("user", expr="repository.findByUuidString(id)")
     */
    public function disableAccount(Request $request, User $user, UserService $userService): Response
    {
        if ($this->isCsrfTokenValid('disableAccount'.$user->getId(), $request->request->get('_token'))) {
            $userService->disableAccount($user->getId());
            $this->addFlash(
                'success',
                'flash.user.was.disabled'
            );
        }

        return $this->redirectToRoute('admin_user_index');
    }
}
