<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BlogBundle\Entity\Comment;
use BlogBundle\Entity\Post;
use BlogBundle\Form\Type\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CommentController extends Controller
{
    /**
     * @ParamConverter("post", class="BlogBundle:Post", options={"id" = "postId"})
     */
    public function newAction(Request $request, Post $post)
    {
        $comment = new Comment();
        $comment->setAuthor($this->getUser());
        $comment->setPost($post);

        $form = $this->createForm(CommentType::class, $comment, [
          'action' => $this->generateUrl('blog_new_post_comment', ['postId' => $post->getId()])
        ]);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($comment);
            $em->flush($comment);

            return $this->redirectToRoute('blog_post', ['id' => $post->getId()]);
        }

        return $this->render('BlogBundle:Comment:new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
