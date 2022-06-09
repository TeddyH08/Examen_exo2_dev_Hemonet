<?php

    namespace App\Controller;

    use App\Entity\Admin;
    use App\Form\AddUserType;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    use Symfony\Component\Routing\Annotation\Route;

    class AdduserController extends AbstractController {
        /**
         * @Route("/add_user", name="add_user")
         * @return Response
         */
        public function index(
            Request $request,
            EntityManagerInterface $manager,
            UserPasswordHasherInterface $passwordHasher
            ): Response 
        {
            $users = new Admin();
            $users->setRoles(['ROLE_ADMIN']);

            $form = $this->createForm(AddUserType::class, $users, ['attr' => ['class' => 'form_ins']]);

            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {
                $plaintextPassword = $users->getPassword();
                $hashedPassword = $passwordHasher->hashPassword(
                    $users,
                    $plaintextPassword
                );
                $users->setPassword($hashedPassword);

                $manager->persist($users);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'L\'utilisateur a bien été inscrit.'
                );

                return $this->redirectToRoute('admin');
            }
            return $this->render('pages/add/adduser.html.twig', [
                "form" => $form->createView()
            ]);
        }
    }