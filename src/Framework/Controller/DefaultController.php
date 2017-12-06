<?php

namespace App\Framework\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\Runtasty;

class DefaultController extends Controller {
    /**
     * @Route("/", name="home")
     */
    public function home (Request $request, Runtasty $runtasty): JsonResponse{
        $page = $request->query->get('page', 1);
        $response = new JsonResponse($runtasty->getReceip($page));
        return $response;
    }
}
