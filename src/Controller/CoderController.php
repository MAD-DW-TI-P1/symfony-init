<?php

namespace App\Controller;

use App\Entity\Coder;
use App\Form\CoderType;
use App\Repository\CoderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/coder')]
class CoderController extends AbstractController
{
    #[Route('/', name: 'app_coder_index', methods: ['GET'])]
    public function index(CoderRepository $coderRepository): Response
    {
        return $this->render('coder/index.html.twig', [
            'coders' => $coderRepository->findAll(),
        ]);
    }

    #[Route('/apicoder', name: 'app_apicoder_index', methods: ['GET'])]
    public function indexapicoder(CoderRepository $coderRepository): Response
    {
        $coder = $coderRepository->findAll();
        $data = [];
        foreach ($coder as $c) {
            $data[] = [
                'id' => $c->getId(),
                'edad' => $c->getEdad()
            ];
        }
        // return $this->render('coder/index.html.twig', [
        //     'coders' => $coderRepository->findAll(),
        // ]);
        return $this->json($data, $status = 200, $headers = ['Access-Control-Allow-Origin'=>'*']);
    }
     //apicoder/eva
    #[Route('/apicoder/{name}', name: 'app_apicoderpersonaliza_index', methods: ['GET'])]
    public function indexapicoderpersonalizada(Request $request, CoderRepository $coderRepository): Response
    {
        //dump($request->attributes->get('name'));die;
        $coder = $coderRepository->findByNombre($request->attributes->get('name'));
        $data = []; 
        foreach ($coder as $c) {
            $data[] = [
                'id' => $c->getId(),
                'edad' => $c->getEdad(),
            ];
        }
        return $this->json($data, $status = 200, $headers = ['Access-Control-Allow-Origin'=>'*']);
    }

    #[Route('/new', name: 'app_coder_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CoderRepository $coderRepository): Response
    {
        $coder = new Coder();
        $form = $this->createForm(CoderType::class, $coder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coderRepository->save($coder, true);

            return $this->redirectToRoute('app_coder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coder/new.html.twig', [
            'coder' => $coder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coder_show', methods: ['GET'])]
    public function show(Coder $coder): Response
    {
        return $this->render('coder/show.html.twig', [
            'coder' => $coder,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_coder_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Coder $coder, CoderRepository $coderRepository): Response
    {
        $form = $this->createForm(CoderType::class, $coder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coderRepository->save($coder, true);

            return $this->redirectToRoute('app_coder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coder/edit.html.twig', [
            'coder' => $coder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coder_delete', methods: ['POST'])]
    public function delete(Request $request, Coder $coder, CoderRepository $coderRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coder->getId(), $request->request->get('_token'))) {
            $coderRepository->remove($coder, true);
        }

        return $this->redirectToRoute('app_coder_index', [], Response::HTTP_SEE_OTHER);
    }
}
