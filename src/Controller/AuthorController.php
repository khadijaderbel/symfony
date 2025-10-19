<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Attribute\Route;

final class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }
#[Route('/AuthorController', name: '/List_Author')]
public function listAuthors()
{$authors = array(
    array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => 'Victor Hugo', 'email' =>
        'victor.hugo@gmail.com ', 'nb_books' => 100),
    array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => ' William Shakespeare', 'email' =>
        ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
    array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg','username' => 'Taha Hussein', 'email' =>
        'taha.hussein@gmail.com', 'nb_books' => 300),
);
    $nbr= 100;
    $title="djo";
return $this->render("author/list.html.twig",["nbrAuthors"=>$nbr,"firstname"=>$title,"tabAuthors"=>$authors
]);
}

//details by id

    #[Route('/author/{id}', name: 'show_author')]
public function showAuthor($id)
{
    return $this->render('author/show.html.twig',['id'=>$id]);
}


    #[Route('/authorlist', name: 'listauthor')]

    public function list(AuthorRepository $repository)
    {
        $authors= $repository->findAll();
        return $this->render("author/listAuthors.html.twig",
            ['tabAuthors'=>$authors] );
    }

    //add
    #[Route('/addAuthor', name: 'addauthor')]
public function add(ManagerRegistry $doctrine)
{
    $authors= new Author();
    $authors->setUsername("yassine");
    $authors->setEmail("yassine.nefzi@pascal.tn");
    $authors->setNbBooks(2);
    $em=$doctrine->getManager();
    $em->persist($authors);
    $em->flush();
    return $this->redirectToRoute("listauthor");
}

//delete
    #[Route('/removeAuthor/{id}', name: 'removeauthor')]
    public function remove(AuthorRepository$repository,$id,ManagerRegistry $doctrine)
    {
        $authors= $repository->find($id);
        $em=$doctrine->getManager();
        $em->remove($authors);
        $em->flush();
        return $this->redirectToRoute("listauthor");
    }

//update
    #[Route('/update/{id}', name: 'update_authors')]
    public function updateAuthor($id,AuthorRepository $repository,Request $request,ManagerRegistry $doctrine)
    {
        $author= $repository->find($id);
        $form= $this->createForm(AuthorType::class,$author);

        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em= $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute("listauthor");
        }
        return $this->render("author/update.html.twig",
            ['authorformulaire'=>$form]);
    }

    //addwform

    #[Route('/ajoutAuteur', name: 'ajout')]
    public function addWithForm(Request $request,ManagerRegistry $doctrine)
    {
        $author = new Author();
        $form= $this->createForm(AuthorType::class,$author);

        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em= $doctrine->getManager();
            $em->persist($author);
            $em->flush();
            return $this->redirectToRoute("listauthor");
        }
        return $this->render("author/add.html.twig",
            ['authorformulaire'=>$form]);
    }

}

