<?php

namespace App\Controller;
use App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Livre;
use App\Form\LivreType;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Controller\LivreController;
use App\Repository\LivreRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @Route("/user", name="user")
 */
class Usercontroller1Controller extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login()
    {
        return $this->render("hachani.html.twig");
    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(Request $request,SessionInterface $session)
    {
        $email=$request->request->get("email");
        $session->set("email",$email);
        $pass=$request->request->get("pass");
        $session->set("pass",$pass);
        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion(SessionInterface $session)
    {
        $session->clear();
        return $this->redirectToRoute("home");
    }
}
