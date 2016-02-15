<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BlogBundle\Entity\Post;
USE BlogBundle\Form\Type\Tag;
use BlogBundle\Entity\Comment;
use BlogBundle\Form\Type\PostType;
use BlogBundle\Form\Type\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class PostController extends Controller
{
  public function newAction(Request $request)
  {
    $post = new Post();

    $post->setAuthor('bla');

    $form = $this->createForm(PostType::class, $post);

    $form->handleRequest($request);
    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();

      $em->persist($post);
      $em->flush($post);

      return $this->redirectToRoute('blog_post', ['id' => $post->getId()]);
    }

    return $this->render('BlogBundle:Post:new.html.twig', [
      'form' => $form->createView()
    ]);
  }


  /**
  * @ParamConverter("post", class="BlogBundle:Post")
  */
  public function editAction(Request $request, Post $post)
  {
    $form = $this->createForm(PostType::class, $post);

    $form->handleRequest($request);
    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();

      $em->persist($post);
      $em->flush($post);

      return $this->redirectToRoute('blog_post', ['id' => $post->getId()]);
    }

    return $this->render('BlogBundle:Post:new.html.twig', [
      'form' => $form->createView()
    ]);
  }

  /**
  * @ParamConverter("post", class="BlogBundle:Post")
  */
  public function showAction(Request $request, Post $post)
  {

    return $this->render('BlogBundle:Post:show.html.twig', [
      'post' => $post
    ]);
  }

  public function indexAction(Request $request)
  {

    $category_Id = (int)$request->query->get('categoryId');
    $page = $request->query->get('page');
    $title = $request->query->get('title');
    $allTags = $request->query->get('tags');

    if($allTags != ''){
      $tags = explode(',', $allTags);
    } else {
      $tags = [];
    }

    $repository = $this
    ->getDoctrine()
    ->getRepository('BlogBundle:Post');

    $posts = $repository->findAll();

    return $this->render('BlogBundle:Post:index.html.twig', [
      'posts' => $posts,
    ]);
  }

  /**
  * @ParamConverter("post", class="BlogBundle:Post")
  */
  public function destroyAction(Request $request, Post $post)
  {
    $em = $this->getDoctrine()->getEntityManager();
    $em->remove($post);
    $em->flush();

    return $this->redirectToRoute('blog_posts');
  }
}
