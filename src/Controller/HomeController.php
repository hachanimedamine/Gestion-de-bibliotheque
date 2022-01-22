<?php

namespace App\Controller;

use App\Entity\Emprunter;
use App\Form\EmprunterType;
use App\Repository\EmprunterRepository;
use App\Entity\Livre;
use App\Form\LivreType;
use App\Controller\LivreController;
use App\Repository\LivreRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Auteur;
use App\Form\AuteurType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\Mapping as ORM;

class HomeController extends AbstractController
{
    /**
 *@Route("/",name="home")
 */
public function home(): Response
{
    return $this->render('home/index.html.twig');
}

 

/**
 *@Route("/recherche",name="recherche")
 */
    public function recherche(Request $r)
    {
       
       $recherche=$r->query->get("cab"); 
       $Livres = $this->getDoctrine()->getManager()->getRepository(Livre::class)->findBy(["titre" => $recherche]);
       $Auteur= $this->getDoctrine()->getManager()->getRepository(Auteur::class)->findBy(["nom"=>$recherche]);
         return $this->render("home/recherche.html.twig",["Livre"=>$Livres,"Auteur"=>$Auteur]);
      
         
    }

/**
 *@Route("/list",name="list")
 */
    

public function List(Request $request)
{
    $list =$request->query->get("cabb");
    $Livres = $this->getDoctrine()->getManager()->getRepository(Livre::class)->findAll();
   $Auteur= $this->getDoctrine()->getManager()->getRepository(Auteur::class)->findAll();
   return $this->render("home/list.html.twig",["Livres"=>$Livres]);
}

    /**
 *@Route("/register",name="register")
 */
public function register()
{
    return $this->render('home/register.html.twig');
}
   /**
 *@Route("/collection",name="collection")
 */
    

public function collect(Request $request)
{
    $collection =$request->query->get("emp");
    $emprunter = $this->getDoctrine()->getManager()->getRepository(Emprunter::class)->findAll();
   return $this->render("emprunter/collection.html.twig",["emprunter"=>$emprunter]);
}

}


