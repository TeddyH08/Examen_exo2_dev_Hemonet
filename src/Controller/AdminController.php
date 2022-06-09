<?php

    namespace App\Controller;

    use App\Repository\ProjetsexamRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class AdminController extends AbstractController {

        /**
         * @var ProjetsRepository
         */
        private $repository;

        public function __construct(ProjetsexamRepository $repository){
            $this->repository = $repository;
        }

        /**
         * @Route("/admin", name="admin")
         * @return Response
         */
        public function index(): Response {
            $projets = $this->repository->findAll();

            return $this->render('pages/admin.html.twig', [
                "projets" => $projets
            ]);
        }
    }