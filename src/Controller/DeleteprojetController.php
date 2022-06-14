<?php

    namespace App\Controller;

    use App\Entity\Projetsexam;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

    class DeleteprojetController extends AbstractController {

        /**
         * @Route("/delete_projet/{id}", name="delete_projet", methods={"GET","POST"})
         * @return Response
         */
        #[IsGranted('ROLE_ADMIN')]
        public function delete(
            Projetsexam $projets,
            EntityManagerInterface $manager,
        ): Response {
            $manager->remove($projets);
            $manager->flush();

            $this->addFlash(
                'delete',
                'Le projet a bien été supprimé.'
            );

            return $this->redirectToRoute('admin');
        }
    }