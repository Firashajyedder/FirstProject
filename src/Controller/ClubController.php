<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    /**
     * @Route("/club", name="club")
     */
    
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }

     /**
     * @Route("/club/getName", name="club2")
     */
    public function getName($nom)
    {
         
    }
    /**
     * @Route("/liste", name="club3")
     */
    
    public function liste(): Response
    {$formations = array(
        array('ref' => 'form147', 'Titre' => 'Formation Symfony
        4','Description'=>'formation pratique',
        'date_debut'=>'12/06/2020', 'date_fin'=>'19/06/2020',
        'nb_participants'=>19) ,
        array('ref'=>'form177','Titre'=>'Formation SOA' ,
        'Description'=>'formation
        theorique','date_debut'=>'03/12/2020','date_fin'=>'10/12/2020',
        'nb_participants'=>0),
        array('ref'=>'form178','Titre'=>'Formation Angular' ,
        'Description'=>'formation
        theorique','date_debut'=>'10/06/2020','date_fin'=>'14/06/2020',
        'nb_participants'=>12));
        return $this->render('club/liste.html.twig', [
            'tab' => $formations
        ]);
    }

}
