<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class ConnexionController extends AbstractController {
        /**
         * @Route("/connexion", name="connexion.index", methods={"GET","POST"})
         * @return Response
         */
        public function login(): Response {
            return $this->render('pages/connexion.html.twig');
        }

        /**
         * @Route("/deconnexion", name="connexion.logout")
         */
        public function logout() {
            //Nothing to do here
        }
    }