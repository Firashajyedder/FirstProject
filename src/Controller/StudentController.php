<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use  App\Repository\EntityRepository;
use App\Entity\Student;
use App\Form\StudentType;
use App\Form\SearchStudentType;
use Symfony\Component\HttpFoundation\Request;
class StudentController extends AbstractController
{
public function index1()
{
    return $this->render('index1.html.twig',['greeting' => 'bnj mes etuds' ,]);

}
 /**
     * @Route("/listes", name="listes")
     */
    public function list(Request $request): Response
    {
     
         
        $searchForm = $this->createForm(SearchStudentType::class);
        $searchForm->handleRequest($request);
       
        $rep = $this->getDoctrine()->getRepository(Student::class);
        $students = $rep->findAll();

        

        if ($searchForm->isSubmitted()) 
        {
            $nsc = $searchForm['NSC']->getData();
       
            $student = $rep-> findOneByNSC($nsc);
            return $this->render('student/listStudentNSC.html.twig', array(
                "student" => $student,
                "searchForm" => $searchForm->createView()));
        }

        return $this->render('student/liste.html.twig', [
          'students'=>$students,'searchForm'=>$searchForm->createView()
     ]);
 
    }
 /**
     * @Route("/deletes/{id}", name="deletes")
     */
    public function delete($id): Response
    { $rep=$this->getDoctrine()->getRepository(student::class);
      $em=$this->getDoctrine()->getManager();
      $student=$rep->find($id);
      $em->remove($student);
      $em->flush();

        return $this->redirectToRoute('listes');
       
    }
 /**
     * @Route("/ajouterStudent", name="ajouters")
     */
    public function ajouter(Request $request): Response
    {
        $student = new Student();
        $form=$this->createForm(StudentType::class,$student);
        $form->handleRequest($request);
        
       
        if($form->isSubmitted()){
            $student = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();
            return $this->redirectToRoute('listes');

        }
        
        
        return $this->render('student/add.html.twig', [
            'formA' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/modifierStudent/{id}", name="modifiers")
     */
    public function modifier(Request $request, $id): Response
    {
        $rep=$this->getDoctrine()->getRepository(student::class);
        $student = $rep->find($id);
        $form=$this->createForm(StudentType::class,$student);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listes');

        }

        return $this->render('classroom/update.html.twig', [
            'formA' => $form->createView()
        ]);
    }

    

    /**
     * @Route("/listeemail", name="listeemail")
     */
    public function listmail(): Response
    {
     
    $repository=$this->getDoctrine()->getRepository(Student::class);
    $student=$repository-> findStudentByEmail();
    
    {
        return $this->render('student/listem.html.twig', [
            'stud' => $student,
        ]);
    }
}
/**
     * @Route("/listeclasse", name="listeclasse")
     */
    public function listerr(): Response
    {
     
    $repository=$this->getDoctrine()->getRepository(Student::class);
    $student=$repository->findOneByClasse(2);
    
    {
        return $this->render('student/lister.html.twig', [
            'class' => $student,
        ]);
    }}

    /**
     * @Route("/listeetud", name="listeetud")
     */
    public function listetud(): Response
    {
     
    $repository=$this->getDoctrine()->getRepository(Student::class);
    $student=$repository-> findOneBySomeField();
    {
        return $this->render('student/listetud.html.twig', [
            'stud' => $student,
        ]);
    }
}
  /**
     * @Route("/listStudentByDate", name="listStudentByDate")
     */
    public function listStudentByDate()
    {

        $students= $this->getDoctrine()->getRepository(Student::class)->orderByDate();
        return $this->render('student/listStudentByDate.html.twig', [
            "student"=>$students,
           ]);
    }


      /**
     * @Route("/student/listStudentEnabled", name="listStudentEnabled")
     */
    public function listStudentEnabled()
    {

        $students= $this->getDoctrine()->getRepository(Student::class)->EnabledStudent();
        return $this->render('student/listStudentsEnabled.html.twig', [
            "students"=>$students,
        ]);
    }



   
     /**
     * @Route("/student/listStudentWithhDate", name="listStudentWithhDate")
     */
    public function listStudentWithhDate()
    {
        $rep = $this->getDoctrine()->getRepository(Student::class);
      
        $students = $rep->studentsDate(new DateTime('2000-11-02'),new DateTime('2002-11-02'));
        return $this->render('student/listWithSearchDate.html.twig', ['students' => $students]);
    }


    /**
     * @Route("/student/searchStudentByMoy", name="searchStudentByMoy")
     */
    public function searchStudentByMoy(Request $request){
        $rep = $this->getDoctrine()->getRepository(Student::class);
        //Show all students
        $students = $rep->findAll();
        //Formulaire de recherche
        $searchForm = $this->createForm(SearchStudentByMoyType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $minMoy=$searchForm['minMoy']->getData();
            $maxMoy=$searchForm['maxMoy']->getData();
            $resultOfSearch = $rep->findStudentByMOY($minMoy,$maxMoy);
            return $this->render('student/searchStudentByMoy.html.twig', [
                'students' => $resultOfSearch,
                'searchStudent' => $searchForm->createView()]);
        }
        return $this->render('student/searchStudentByMoy.html.twig', ['students' => $students,'searchStudent'=>$searchForm->createView()]);

    }



    
     /**
     * @Route("/student/listStudentredoublant", name="listStudentredoublant")
     */
    public function listStudentredoublant()
    {
        $students= $this->getDoctrine()->getRepository(Student::class)->findlStudentredoublant();
        return $this->render('student/listeReoudoublant.html.twig', [
            "students"=>$students,
        ]);
    }




}

?> 