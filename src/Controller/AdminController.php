<?php

    namespace App\Controller;

    use App\Repository\ProjetsexamRepository;
    use App\Repository\AdminRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

    class AdminController extends AbstractController {

        /**
         * @var ProjetsexamRepository
         * @var AdminRepository
         */
        private $projetsrepository;
        private $adminrepository;

        public function __construct(ProjetsexamRepository $projetsrepository, AdminRepository $adminrepository){
            $this->projetsrepository = $projetsrepository;
            $this->adminrepository = $adminrepository;
        }

        /**
         * @Route("/admin", name="admin")
         * @return Response
         */
        #[IsGranted('ROLE_ADMIN')]
        public function index(): Response {
            $projets = $this->projetsrepository->findAll();
            $users = $this->adminrepository->findAll();

            return $this->render('pages/admin.html.twig', [
                "projets" => $projets,
                "users" => $users
            ]);
        }
    }