<?php

    namespace App\Controller;

    use App\Entity\Projetsexam;
    use App\Form\EditProjetType;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Doctrine\ORM\EntityManagerInterface;

    class EditprojetController extends AbstractController {

        /**
         * @Route("/edit_projet/{id}", name="edit_projet")
         * @return Response
         */
        public function edit(
            Projetsexam $projets,
            Request $request,
            EntityManagerInterface $manager,
        ): Response {
            $form = $this->createForm(EditProjetType::class,  $projets, ['attr' => ['class' => 'form_ins']]);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $projets = $form->getData();

                $manager->persist($projets);
                $manager->flush();

                $this->addFlash(
                    'update',
                    'L\'utilisateur a bien été modifié.'
                );

                return $this->redirectToRoute('admin');
            }

            return $this->render('pages/edit/edituser.html.twig', [
                "form" => $form->createView()
            ]);
        }
    }