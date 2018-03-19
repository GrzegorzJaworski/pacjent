<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Patient;
use AppBundle\Form\PatientFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PatientController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $patients = $this->getDoctrine()->getRepository(Patient::class)->findBy(['isDelte'=>false]);

        return $this->render('home.html.twig', ['patients' => $patients]);
    }

    /**
     * @Route("/new", name="new")
     * @Security("has_role('ROLE_ADMIN')")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {

        $form = $this->createForm(PatientFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $patient = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($patient);
            $em->flush();

            $this->addFlash('success', 'Patient created!');
            return $this->redirectToRoute('home');
        }

        return $this->render('new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     * @Security("has_role('ROLE_ADMIN')")
     * @param Request $request
     * @param Patient $patient
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Patient $patient)
    {
        $form = $this->createForm(PatientFormType::class, $patient);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $patient = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($patient);
            $em->flush();

            $this->addFlash('success', 'Patient Updated!');

            return $this->redirectToRoute('home');
        }

        return $this->render('edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/remove/{id}", name="remove")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function removeAction(Patient $patient)
    {
        $patient->setIsDelte(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($patient);
        $em->flush();

        $this->addFlash('success', 'Patient Removed!');

        return $this->redirectToRoute('home');
    }
}