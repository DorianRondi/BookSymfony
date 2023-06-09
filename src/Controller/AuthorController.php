<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(AuthorRepository $authorRepository): Response
    {
        return $this->render('author/index.html.twig', [
            'title' => "Author List",
            'authors' => $authorRepository->findAll()
        ]);
    }

    #[Route('/author/add', name: 'app_author_add')]
    public function addAuthor(Request $request, AuthorRepository $authorRepository): Response
    {
        $formulaire = $this->createForm(AuthorType::class);
        $formulaire->handleRequest($request);
        if($formulaire->isSubmitted() && $formulaire->isValid()){
            $author = $formulaire->getData();
            $authorRepository->save($author,true);

            return $this->redirectToRoute("app_author");
        }
        return $this->render('author/add.html.twig', [
            'title' => "Add Author",
            'form' => $formulaire
        ]);
    }
    
    #[Route('/author/{id<\d+>}', name: 'app_author_show')]
    public function show(Author $author): Response
    {
        return $this->render('author/show.html.twig', [
            'title' => $author->getName(),
            'author' => $author
        ]);
    }

    #[Route('/author/{id<\d+>}/edit', name: 'app_author_edit')]
    public function editAuthor(Author $author, Request $request, AuthorRepository $authorRepository): Response
    {
        $formulaire = $this->createForm(AuthorType::class, $author);
        $formulaire->handleRequest($request);
        if($formulaire->isSubmitted() && $formulaire->isValid()){
            $authorRepository->save($author,true);
            return $this->redirectToRoute("app_author");
        }
        return $this->render('author/edit.html.twig', [
            'title' => $author->getName(),
            'author' => $author,
            'form' => $formulaire
        ]);
    }

    #[Route('/author/{id<\d+>}/delete', name: 'app_author_delete')]
    public function deleteAuthor(Author $author, AuthorRepository $authorRepository): Response
    {
        $authorRepository->remove($author,true);
        return $this->redirectToRoute("app_author");
    }

    /*
    #[Route('/author/{id<\d+>}/delete', name: 'app_author_delete')]
    public function deleteAuthor(Author $author, EntityManagerInterface $em): Response
    {
        $em->remove($author);
        $em->flush();
        
        return $this->redirectToRoute("app_author");
    }
    */
}
