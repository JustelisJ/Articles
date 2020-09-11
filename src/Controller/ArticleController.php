<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route ("/", methods={"GET"})
     */
    public function index()
    {
        // return new Response('<html><body>Hello</body></html>');
        $articles = ["Article 1", "Article 2"];
        return $this->render('articles/index.html.twig', array("articles" => $articles));
    }
}