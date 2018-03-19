<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PacketType;
use AppBundle\Form\PacketTypeFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PacketController extends Controller
{
    /**
     * @Route("/packet/type", name="packet_type")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $packets = $this->getDoctrine()->getRepository(PacketType::class)->findAll();

        return $this->render('packetType.html.twig', [
            'packets' => $packets,
        ]);
    }

    /**
     * @Route("/packet/type/new", name="pacekt_type_new")
     * @Security("has_role('ROLE_ADMIN')")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(PacketTypeFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $packetType = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($packetType);
            $em->flush();

            $this->addFlash('success', 'Packet Type created!');
            return $this->redirectToRoute('packet_type');
        }

        return $this->render('packetType/add.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
