<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class IndexController extends AbstractController {
        /**
         * @Route("/index", name="index")
         * @return Response
         */
        public function index(): Response {
            return $this->render('pages/index.html.twig');
        }
    }