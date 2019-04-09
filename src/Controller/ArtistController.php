<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\CreateArtistType;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/artist", name="artist_")
 */
class ArtistController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(ArtistRepository $artistRepository)
    {
        $actors = $artistRepository->findAll();

        //dump($myArtists);
        //die;
        return $this->render('artist/index.html.twig', [
            'controller_name' => 'ArtistController',
            'my_var' => 'This friendly message is coming from:',
            'actors' => $actors,
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $newArtist = new Artist();
        $form = $this->createForm(CreateArtistType::class, $newArtist);
        //Traitement des données envoyées par le navigateur
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            //dump($form->getData());
            $em->persist($newArtist);
            $em->flush();
            return $this->redirectToRoute('artist_index');
        }
        return $this->render('artist/create.html.twig', [
            'creationForm' => $form->createView()
        ]);

    }

    /**
     * @Route("/create_manually", name="create_manually")
     */
    public function create_manually(Request $request, EntityManagerInterface $em)
    {
        $newArtist = new Artist();

        $formBuilder = $this->createFormBuilder($newArtist);

        //Ajout des champs
        $formBuilder
            ->add('firstName', null, ['label' => "Given name"])
            ->add('lastName', null, ['label' => "Family name"])
            ->add('save', SubmitType::class);

        //Obtention d'un formulaire qu'on peut traiter
        $form = $formBuilder->getForm();

        //Traitement des données envoyées par le navigateur
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            //dump($form->getData());
            $em->persist($newArtist);
            $em->flush();
            return $this->redirectToRoute('artist_index');
        }
        return $this->render('artist/create.html.twig', [
            'creationForm' => $formBuilder->getForm()->createView()
        ]);
    }

    /**
     * @Route("/{artistId}", name="show")
     */
    public function show($artistId)
    {
        return $this->render('artist/index.html.twig', [
            'controller_name' => 'ArtistController',
            'my_var' => 'This friendly message is coming from:'
        ]);
    }
}
