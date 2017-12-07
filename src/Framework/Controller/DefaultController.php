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
    
    /**
     * @Route("/api/ingredients", name="ingredients", methods={"GET"})
     */
    public function ingredients (Request $request, Runtasty $runtasty): JsonResponse{
        $page = $request->query->get('page', 1);
        $limit = $request->query->get('limit', 10);
        $response = new JsonResponse($runtasty->getIngredient($page, $limit));
        return $response;
    }
    
    /**
     * @Route("/api/ingredients/{ingredient}", name="ingredients_receips", methods={"GET"})
     */
    public function ingredientsReceips (string $ingredient, Request $request, Runtasty $runtasty): JsonResponse{
        $page = $request->query->get('page', 1);
        $response = new JsonResponse($runtasty->getReceip($page, '', $ingredient));
        return $response;
    }
}
