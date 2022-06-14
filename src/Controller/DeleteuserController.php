<?php

    namespace App\Controller;

    use App\Entity\Admin;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

    class DeleteuserController extends AbstractController {

        /**
         * @Route("/delete_user/{id}", name="delete_user", methods={"GET","POST"})
         * @return Response
         */
        #[IsGranted('ROLE_ADMIN')]
        public function delete(
            Admin $users,
            EntityManagerInterface $manager,
        ): Response {
            $manager->remove($users);
            $manager->flush();

            $this->addFlash(
                'delete',
                'L\'utilisateur a bien été supprimé.'
            );

            return $this->redirectToRoute('admin');
        }
    }