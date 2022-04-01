<?php

namespace App\Controller;

use Doctrine\ORM\EntityRepository;
use App\Entity\Leads;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\LeadsRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/create_lead", name="create_lead")
     */
    public function create_lead(): Response
    {
        return $this->render('home/create_lead.html.twig',  [
            'status' => '',
        ]);
    }

    /**
     * @Route("insert_lead", name="insert_lead")
     */
    public function insert_lead(Request $request)
    {
        $lead = new Leads;
        $lead->setLeadName($request->get('name'));
        $lead->setLeadCompany($request->get('company'));
        $lead->setLeadDomain($request->get('domain'));
        $lead->setLeadBroadcastStatus($request->get('Lead_broadcast_status'));
        $lead->setLeadCreatedBy($this->getUser()->getUsername());

        $en = $this->getDoctrine()->getManager();
        $en->persist($lead);
        $en->flush();
        return $this->render('home/create_lead.html.twig', [
            'status' => 'Saved',
        ]);
    }

    /**
     * @Route("my_leads", name="my_leads")
     */
    public function my_leads()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Leads::class);
        $products = $repository->findAll();
        // return $this->render('$0.html.twig', []);
        return $this->render('home/my_leads.html.twig',  [
            'status' => '',
            'data' => $products
        ]);
    }

    /**
     * @Route("broad_leads", name="broad_leads")
     */
    public function broad_leads()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Leads::class);
        $products = $repository->findAll();
        // return $this->render('$0.html.twig', []);
        return $this->render('home/broad.html.twig',  [
            'status' => '',
            'data' => $products
        ]);
    }

    /**
     * @Route("delete_lead/{id}", name="delete_lead")
     */
    public function delete_lead($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $single_user = $this->getDoctrine()->getRepository(Leads::class)->findOneBy(['id' => $id]);

        $entityManager->remove($single_user);

        $entityManager->flush();
        // return $this->render('$0.html.twig', []);
        return $this->redirect($this->generateUrl('my_leads'));
    }
    /**
     * @Route("update_lead/{id}", name="update_lead")
     */
    public function update_lead($id, Request $request)
    {


        $entityManager = $this->getDoctrine()->getManager();
        $single_lead = $this->getDoctrine()->getRepository(Leads::class)->findOneBy(['id' => $id]);


        return $this->render('home/update_lead.html.twig',  [
            'status' => '',
            'lead' => $single_lead
        ]);
    }

    /**
     * @Route("update_single_lead", name="update_single_lead")
     */
    public function update_single_lead(Request $request)
    {
        $single_lead = $this->getDoctrine()->getRepository(Leads::class)->findOneBy(['id' => $request->get('id')]);

        $single_lead->setLeadName($request->get('name'));
        $single_lead->setLeadCompany($request->get('company'));
        $single_lead->setLeadDomain($request->get('domain'));
        $single_lead->setLeadBroadcastStatus($request->get('Lead_broadcast_status'));

        $en = $this->getDoctrine()->getManager();
        $en->persist($single_lead);
        $en->flush();

        return $this->redirect($this->generateUrl('my_leads'));
    }
}
