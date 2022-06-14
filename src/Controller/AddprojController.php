<?php

    namespace App\Controller;

    use App\Entity\Projetsexam;
    use App\Form\AddProjType;
    use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;

    class AddprojController extends AbstractController {
        /**
         * @Route("/add_proj", name="add_proj")
         * @return Response
         */
        #[IsGranted('ROLE_ADMIN')]
        public function index(
            Request $request,
            EntityManagerInterface $manager,
            ): Response 
        {
            $projs = new Projetsexam();

            $form = $this->createForm(AddProjType::class, $projs, ['attr' => ['class' => 'form_ins']]);

            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {

                $manager->persist($projs);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Le projet a bien été ajouté.'
                );

                return $this->redirectToRoute('admin');
            }
            return $this->render('pages/add/addproj.html.twig', [
                "form" => $form->createView()
            ]);
        }
    }