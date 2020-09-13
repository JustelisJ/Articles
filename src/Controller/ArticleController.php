<?php
namespace App\Controller;

use App\Entity\Article;
use Doctrine\DBAL\Types\TextType as TypesTextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
     * @Route("/article/new", name="new_article", methods={"GET", "POST"})
     */
    public function new(Request $request)
    {
        $article = new Article();

        $form = $this->createFormBuilder($article)
            ->add("title", TextType::class, array('attr' => 
                array('class' => 'form-control')
            ))
            ->add("body", TextareaType::class, array(
                'required'=> false,
                'attr' => array('class' => 'form-control')
            ))
            ->add("save", SubmitType::class, array(
                'label' => 'Create article',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        return $this->render("articles/new.html.twig", array(
            'form' => $form->createView()
        ));
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