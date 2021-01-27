<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Form\AnnoncesType;
use App\Form\EditProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="app_users")
     */
    public function index(): Response
    {
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

    /**
     * @Route("/users/annonces/add", name="app_users_annonces_add")
     */
    public function addAnnonces(Request $request): Response
    {
        $annonce = new Annonces;

        $form = $this->createForm(AnnoncesType::class, $annonce);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annonce->setUsers($this->getUser());
            $annonce->setActive(false);

            $em = $this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute('app_users');
        }

        return $this->render('users/annonces/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/users/profile/edit", name="app_users_profile_edit")
     */
    public function editProfile(Request $request): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(EditProfileType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'User profile updated');
            return $this->redirectToRoute('app_users');
        }

        return $this->render('users/edit_profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/users/password/edit", name="app_users_password_edit")
     */
    public function editPassword(Request $request, UserPasswordEncoderInterface $pwdEncoder): Response
    {
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();

            // Check if the two passwords matches
            if ($request->request->get('new-password') == $request->request->get('confirm-password')) {

                $user->setPassword($pwdEncoder->encodePassword($user, $request->request->get('new-password')));
                $em->flush();

                $this->addFlash('message', 'Passwords updated successfully!');

                $this->redirectToRoute('app_users');
            } else {
                $this->addFlash('message', 'Entered passwords don\'t match');
            }
        } else {
            # code...
        }

        return $this->render('users/edit_password.html.twig');
    }
}
