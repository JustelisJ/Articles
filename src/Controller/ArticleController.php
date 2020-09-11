<?php
namespace App\Controller;

use App\Entity\Article;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    /**
     * @Route ("/", methods={"GET"}, name="article_list")
     */
    public function index()
    {
        // return new Response('<html><body>Hello</body></html>');
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        return $this->render('articles/index.html.twig', array("articles" => $articles));
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function show(int $id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        return $this->render("articles/show.html.twig", array("article" => $article));
    }

    // /**
    //  * @Route("/article/save")
    //  */
    // public function save()
    // {
    //     $entityManeger = $this->getDoctrine()->getManager();

    //     $article = new Article();
    //     $article->setTitle("Second title");
    //     $article->setBody("Some text for the second article");

    //     $entityManeger->persist($article);
    //     $entityManeger->flush();

    //     return new Response('Saved new article with id '. $article->getId());
    // }
}