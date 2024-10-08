<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/author/{name}', name: 'author_show')]
    public function showAuthor(string $name,  $authorRepository): Response
    {
        // Récupérer l'auteur par son nom
        $author = $authorRepository->findOneBy(['name' => $name]);

        // Si l'auteur n'existe pas, renvoyer une 404
        if (!$author) {
            throw $this->createNotFoundException("L'auteur avec le nom \"$name\" n'existe pas.");
        }

        // Renvoyer la vue avec les détails de l'auteur
        return $this->render('author/show.html.twig', [
            'author' => $author,
        ]);
    }
    #[Route('/author/details/{id}', name: 'author_details')]
public function authorDetails(int $id): Response
{
    $authors = [
        1 => ['id' => 1, 'picture' => '/images/Victor-Hugo.jpg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com', 'nb_books' => 100],
        2 => ['id' => 2, 'picture' => '/images/william-shakespeare.jpg', 'username' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com', 'nb_books' => 200],
        3 => ['id' => 3, 'picture' => '/images/Taha_Hussein.jpg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300],
    ];

    $author = $authors[$id];

    return $this->render('author/showAuthor.html.twig', [
        'author' => $author,
    ]);
}

}
