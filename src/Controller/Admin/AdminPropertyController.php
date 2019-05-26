<?php

namespace App\Controller\Admin;

use App\Entity\Option;
use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(PropertyRepository $repository,ObjectManager $manager)
    {

        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @Route("/admin",name="admin.property.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/property/index.html.twig',compact('properties'));
    }

    /**
     * @Route("/admin/offres/create",name="admin.property.new")
     */
    public function new(Request $request)
    {
        $property = new Property();

        $form = $this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->manager->persist($property);
            $this->manager->flush();
            $this->addFlash('success','Nouvelle offre crée avec succes');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin/property/new.html.twig',[
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/offres/{id}",name="admin.property.edit",methods="GET|POST")
     */
    public function edit(Property $property,Request $request)
    {
        //$option = new Option();
        //$property->addOption($option);

        $form = $this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->manager->flush();
            $this->addFlash('success','Offre modifiée avec succes');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin/property/edit.html.twig',[
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/offres/{id}",name="admin.property.delete", methods="DELETE")
     * @param Property $property
     */
    public function delete(Property $property,Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $property->getId(),$request->get('_token')))
        {
        $this->manager->remove($property);
        $this->manager->flush();
        $this->addFlash('success','Offre supprimée avec succes !');
        }

        return $this->redirectToRoute('admin.property.index');
    }
}