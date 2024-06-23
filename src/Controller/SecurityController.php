<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    /**
     * Connexion
     */
<<<<<<< HEAD
    #[Route('/', name: 'app_login')]
=======
    #[Route('/login', name: 'app_login')]
>>>>>>> 9c43fc10adf136ce5c6487dff5db11d01a0ec247
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * Déconnexion
     */
    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * Accéder à son profil
     */
    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        if ($this->getUser()) {
            return $this->render('security/profile.html.twig');
        } else {
            return $this->redirectToRoute("app_login");
        }
    }
}