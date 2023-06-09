<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(BookRepository $bookRepository): Response
    {
        return $this->render('book/index.html.twig', [
            'title' => 'Book List',
            'books' => $bookRepository->findAll()
        ]);
    }

    #[Route('/book/add', name: 'app_book_add')]
    public function add(Request $request, BookRepository $bookRepository): Response
    {
        $formulaire = $this->createForm(BookType::class);
        $formulaire->handleRequest($request);
        if($formulaire->isSubmitted() && $formulaire->isValid()){
            $book = $formulaire->getData();
            $bookRepository->save($book,true);

            return $this->redirectToRoute('app_book');
        }
        return $this->render('book/add.html.twig', [
            'title' => 'Add Book',
            'form' => $formulaire
        ]);
    }

    #[Route('/book/add/author/{id<\d+>}', name: 'app_book_add_id')]
    public function addFromAuthor(Author $author,Request $request, BookRepository $bookRepository): Response
    {   
        $book = new Book;
        $book->setAuthor($author);
        $formulaire = $this->createForm(BookType::class, $book);
        $formulaire->handleRequest($request);
        if($formulaire->isSubmitted() && $formulaire->isValid()){
            $book = $formulaire->getData();
            $bookRepository->save($book,true);

            return $this->redirectToRoute('app_author_show',[
                'id' => $author->getId()
            ]);
        }
        return $this->render('book/add.html.twig', [
            'title' => 'Add Book',
            'form' => $formulaire
        ]);
    }
    
    #[Route('/book/{id<\d+>}/edit', name: 'app_book_edit')]
    public function edit(Book $book, Request $request, BookRepository $bookRepository): Response
    {
        $formulaire = $this->createForm(BookType::class, $book);
        $formulaire->handleRequest($request);
        if($formulaire->isSubmitted() && $formulaire->isValid()){
            $bookRepository->save($book,true);
            return $this->redirectToRoute("app_book");
        }
        return $this->render('book/edit.html.twig', [
            'title' => $book->getTitle(),
            'book' => $book,
            'form' => $formulaire
        ]);
    }

    #[Route('/book/{id<\d+>}', name: 'app_book_show')]
    public function show(Book $book): Response
    {
        return $this->render('book/show.html.twig', [
            'title' => $book->getTitle(),
            'book' => $book
        ]);
    }

    #[Route('/book/{id<\d+>}/delete', name: 'app_book_delete')]
    public function delete(Book $book, BookRepository $bookRepository): Response
    {
        $bookRepository->remove($book,true);
        return $this->redirectToRoute("app_book");
    }
}
