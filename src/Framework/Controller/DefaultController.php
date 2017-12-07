<?php

namespace App\Framework\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\Runtasty;

/**
 * @Route("/api")
 */
class DefaultController extends Controller {
    /**
     * @Route("/", name="home")
     * @Method("GET")
     */
    public function home (): Response {
        return new Response(""
                . "<h1>Runtasty API</h1>"
                . "<h2>Obtener recetas</h2>"
                . "<dl>"
                . "<dt><b>/receips</b></dt>"
                . "<dd>page: número de página.</dd>"
                . "<dd>terms: términos a buscar.</dd>"
                . "<dt><b>/ingredients/:ingredient</b></dt>"
                . "<dd>page: número de página.</dd>"
                . "<dd>ingredient: ingrediente que debe contener la receta.</dd>"
                . "<h2>Obtener ingredientes</h2>"
                . "<dt><b>/ingredients</b></dt>"
                . "<dd>limit: número de ingredientes a obtener, por defecto 10.</dd>"
                . "</dl>");
    }
    
    /**
     * @Route("/receips", name="receips")
     * @Method("GET")
     */
    public function receips (Request $request, Runtasty $runtasty): JsonResponse{
        $page = $request->query->get('page', 1);
        $terms = $request->query->get('terms', 1);
        $response = new JsonResponse($runtasty->getReceip($page, $terms));
        return $response;
    }
    
    /**
     * @Route("/ingredients", name="ingredients")
     * @Method("GET")
     */
    public function ingredients (Request $request, Runtasty $runtasty): JsonResponse{
        $page = $request->query->get('page', 1);
        $limit = $request->query->get('limit', 10);
        $response = new JsonResponse($runtasty->getIngredient($page, $limit));
        return $response;
    }
    
    /**
     * @Route("/ingredients/", name="ingredients_receips_default")
     * @Route("/ingredients/{ingredient}", defaults={"ingredient": ""}, name="ingredients_receips")
     * @Method("GET")
     */
    public function ingredientsReceips (Request $request, Runtasty $runtasty, string $ingredient = ""): JsonResponse{
        $page = $request->query->get('page', 1);
        $response = new JsonResponse($runtasty->getReceip($page, '', $ingredient));
        return $response;
    }
}
