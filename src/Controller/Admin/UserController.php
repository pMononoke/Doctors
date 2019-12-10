<?php

namespace App\Controller\Admin;

use App\Dto\RegisterUserDTO;
use App\Dto\UserDTO;
use App\Entity\User;
use App\Form\RegisterUserType;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Service\UserService;
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

    // TODO original function
//    /**
//     * @Route("/new", name="user_new", methods={"GET","POST"})
//     */
//    public function new(Request $request): Response
//    {
//        $user = new User();
//        $form = $this->createForm(UserType::class, $user);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($user);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('user_index');
//        }
//
//        return $this->render('admin/user/new.html.twig', [
//            'user' => $user,
//            'form' => $form->createView(),
//        ]);
//    }

    /**
     * @Route("/new", name="admin_user_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserService $userService): Response
    {
        $user = new RegisterUserDTO();
        $form = $this->createForm(RegisterUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userService->registerUserByAdminWithDtoData($user);

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('admin/user/show.html.twig', [
            'user' => $user,
        ]);
    }


    // TODO original function

//    /**
//     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
//     */
//    public function edit(Request $request, User $user): Response
//    {
//        $form = $this->createForm(UserType::class, $user);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('user_index');
//        }
//
//        return $this->render('admin/user/edit.html.twig', [
//            'user' => $user,
//            'form' => $form->createView(),
//        ]);
//    }

    /**
     * @Route("/{id}/edit", name="admin_user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, UserService $userService): Response
    {
        $userDTO = UserDTO::fromUser($user);
        $form = $this->createForm(UserType::class, $userDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$this->getDoctrine()->getManager()->flush();
            $user->setEmail($userDTO->email);
            $userService->update($user);

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_user_index');
    }
}
