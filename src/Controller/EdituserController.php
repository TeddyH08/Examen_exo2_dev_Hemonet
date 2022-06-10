<?php

    namespace App\Controller;

    use App\Entity\Admin;
    use App\Form\EditUserType;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

    class EdituserController extends AbstractController {

        /**
         * @Route("/edit_user/{id}", name="edit_user")
         * @return Response
         */
        public function edit(
            Admin $users,
            Request $request,
            EntityManagerInterface $manager,
        ): Response {
            $form = $this->createForm(EditUserType::class,  $users, ['attr' => ['class' => 'form_ins']]);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $users = $form->getData();

                $manager->persist($users);
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