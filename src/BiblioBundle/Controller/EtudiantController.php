<?php

namespace BiblioBundle\Controller;


use BiblioBundle\Entity\Etudiant;
use BiblioBundle\Form\EtudiantForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class EtudiantController extends Controller
{

    public function indexAction()
    {
        return new Response( "Bonjour");
        ;
    }
    public function AffichageAction($id)
    {
        return new Response( "Bonjour".$id.".");
        ;
    }

    public function voirAction($name)
    {
        return $this->render('@Biblio/Etudiant/index.html.twig',array('name'=>$name));
    }

    public function listAction()
    {
        $etudiants = array ("hamza","salah","zied");
        return $this->render('@Biblio/Etudiant/list.html.twig',array('etudiants'=>$etudiants ));
    }

    public function addAction()
    {
        $Etudiant = new Etudiant();
        $form = $this->createForm(EtudiantForm::class,$Etudiant);
        return $this->render('@Biblio/Etudiant/add.html.twig',
            array(
                'Form'=>$form->createView()
            ));

    }
}