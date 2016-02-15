<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BlogBundle\Entity\Category;
use BlogBundle\Form\Type\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CategoryController extends Controller
{
  public function newAction(Request $request)
  {
    $category = new Category();

    $form = $this->createForm(CategoryType::class, $category);

    $form->handleRequest($request);
    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();

      $em->persist($category);
      $em->flush($category);

      return $this->redirectToRoute('blog_categories');
    }

    return $this->render('BlogBundle:Category:new.html.twig', [
      'form' => $form->createView()
    ]);
  }


  /**
  * @ParamConverter("category", class="BlogBundle:Category")
  */
  public function editAction(Request $request, Category $category)
  {
    $form = $this->createForm(CategoryType::class, $category);

    $form->handleRequest($request);
    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();

      $em->persist($category);
      $em->flush($category);

      return $this->redirectToRoute('blog_categories');
    }

    return $this->render('BlogBundle:Category:new.html.twig', [
      'form' => $form->createView()
    ]);
  }

  public function indexAction(Request $request)
  {
    $repository = $this
    ->getDoctrine()
    ->getRepository('BlogBundle:Category');

    $categories = $repository->findAll();

    return $this->render('BlogBundle:Category:index.html.twig', ['categories' => $categories]);
  }
}
