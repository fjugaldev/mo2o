<?php

namespace App\Framework\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller {
    /**
     * @Route("/", name="home")
     */
    public function home (Request $request): JsonResponse{
        $response = new JsonResponse(array());
        return $response;
    }
}
