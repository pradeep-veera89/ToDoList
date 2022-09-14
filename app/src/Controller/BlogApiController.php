<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogApiController extends AbstractController
{

    #[Route('/api/posts/{id}', requirements: ['id'=>'\d+'], methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        return $this->json($id);
    }

    #[Route('/api/posts/{id}', methods: ['POST'])]
    public function edit(int $id): Response
    {
        return $this->json($id);
    }

    #[Route('/api/{campaignId}/posts/{blogId}', requirements: ['campaignId'=>'\d+', 'blogId'=> '\d+'] , methods: ['GET'])]
    public function testEdit(int $campaignId, int $blogId): JsonResponse
    {
        return $this->json(['$campaignId'=> $campaignId, 'blogId'=> $blogId]);
    }
}