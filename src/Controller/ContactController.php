<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact", methods={"GET","POST"})
     */
    public function new(Request $request):Response
    {

        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

	    if ($form->isSubmitted() && $form->isValid()) {
	        
	        $contact = $form->getData();
	        $entityManager = $this->getDoctrine()->getManager();
	        $entityManager->persist($contact);
	        $entityManager->flush();

	        return $this->redirectToRoute('homepage');
	    }

        return $this->render('contact/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
