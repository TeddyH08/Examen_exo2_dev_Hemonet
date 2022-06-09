<?php

    namespace App\Controller;

    use App\Entity\Admin;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class EdituserController extends AbstractController {

        /**
         * @Route("/edit_user", name="edit_user")
         * @return Response
         */
        public function edit(): Response {
            return $this->render('pages/edit/edituser.html.twig');
        }
    }