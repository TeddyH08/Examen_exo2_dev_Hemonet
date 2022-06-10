<?php

    namespace App\Controller;

    use App\Entity\Admin;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;

    class DeleteuserController extends AbstractController {

        /**
         * @Route("/delete_user/{id}", name="delete_user", methods={"GET","POST"})
         * @return Response
         */
        public function delete(
            Admin $users,
            EntityManagerInterface $manager,
        ): Response {
            $manager->remove($users);
            $manager->flush();

            $this->addFlash(
                'success',
                'L\'utilisateur a bien été supprimé.'
            );

            return $this->redirectToRoute('admin');
        }
    }