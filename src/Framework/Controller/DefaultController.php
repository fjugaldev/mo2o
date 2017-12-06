<?php

namespace App\Framework\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\Runtasty;

class DefaultController extends Controller {
    /**
     * @Route("/api/receips", name="receips", methods={"GET"})
     */
    public function receips (Request $request, Runtasty $runtasty): JsonResponse{
        $page = $request->query->get('page', 1);
        $terms = $request->query->get('terms', 1);
        $response = new JsonResponse($runtasty->getReceip($page, $terms));
        return $response;
    }
}
