<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use  App\Repository\EntityRepository;
use App\Entity\Classroom;
use App\Form\ClassroomType;
use Symfony\Component\HttpFoundation\Request;
class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }


    
    /**
     * @Route("/liste", name="liste")
     */
    public function list(): Response
    {
     
    $repository=$this->getDoctrine()->getRepository(Classroom::class);
    $classroom=$repository->findAll();
    
    {
        return $this->render('classroom/liste.html.twig', [
            'class' => $classroom,
        ]);
    }
}



    
    /**
     * @Route("/lister", name="lister")
     */
    public function lister(): Response
    {
     
    $repository=$this->getDoctrine()->getRepository(Classroom::class);
    $classroom=$repository->findByExampleField();
    
    {
        return $this->render('classroom/lister.html.twig', [
            'class' => $classroom,
        ]);
    }
}
 /**
     * @Route("/add/{id}", name="add")
     */
    public function add(): Response
    {
        return $this->render('classroom/add.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    /**
     * @Route("/update/{id}", name="update")
     */
    public function update(): Response
    {
        return $this->render('classroom/update.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

     /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id): Response
    { $rep=$this->getDoctrine()->getRepository(classroom::class);
      $em=$this->getDoctrine()->getManager();
      $classroom=$rep->find($id);
      $em->remove($classroom);
      $em->flush();

        return $this->redirectToRoute('liste');
       
    }

    
 /**
     * @Route("/ajouter", name="ajouter")
     */
    public function ajouter(Request $request): Response
    {
        $classroom = new Classroom();
        $form=$this->createForm(ClassroomType::class,$classroom);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            
        }
        if($form->isSubmitted()){
            $classroom = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute('liste');

        }
        
        
        return $this->render('classroom/add.html.twig', [
            'formA' => $form->createView()
        ]);
    }
    /**
     * @Route("/modifier/{id}", name="modifier")
     */
    public function modifier(Request $request, $id): Response
    {
        $rep=$this->getDoctrine()->getRepository(classroom::class);
        $classroom = $rep->find($id);
        $form=$this->createForm(ClassroomType::class,$classroom);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('liste');

        }

        return $this->render('classroom/update.html.twig', [
            'formA' => $form->createView()
        ]);
    }
      
}
