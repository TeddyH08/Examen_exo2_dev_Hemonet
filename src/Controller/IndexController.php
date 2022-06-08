<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class IndexController extends AbstractController {

        // /**
        //  * @var ProjetsRepository
        //  */
        // private $repository;

        // public function __construct(ProjetsRepository $repository){
        //     $this->repository = $repository;
        // }

        /**
         * @Route("/index", name="index")
         * @return Response
         */
        public function index(): Response {
            // $projets = $this->repository->findAll();

            return $this->render('pages/index.html.twig');
        }
    }