<?php

namespace App\Framework\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\Runtasty;

class DefaultController extends Controller {
    /**
     * @Route("/{terms}", name="home", defaults={"terms"=""}, methods={"GET"})
     */
    public function home (string $terms, Request $request, Runtasty $runtasty): JsonResponse{
        $page = $request->query->get('page', 1);
        $response = new JsonResponse($runtasty->getReceip($page, $terms));
        return $response;
    }
}
