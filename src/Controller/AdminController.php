<?php

    namespace App\Controller;

    use App\Entity\Projetsexam;
    use App\Repository\ProjetsexamRepository;
    use App\Repository\AdminRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
    use Dompdf\Dompdf;
    use Dompdf\Options;

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

        /**
         * @Route("/project/data/{id}", name="project_data", methods={"GET"})
         */
        public function projectsDataDownload(Projetsexam $project)
        {
            $pdfOptions = new Options();

            $pdfOptions->set('defaultFont', 'Roboto');
            $pdfOptions->setIsRemoteEnabled(true);

            $dompdf = new Dompdf($pdfOptions);
            $context = stream_context_create([
                'ssl' => [
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                    'allow_self_signed' => TRUE
                ]
            ]);
            $dompdf->setHttpContext($context);

            $html = $this->renderView('pages/mypdf.html.twig', [
                "project" => $project
            ]);

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $fichier = 'data-project.pdf';

            $dompdf->stream($fichier, [
                'Attachment' => true
            ]);

            return new Response();
        }
    }