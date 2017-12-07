<?php

namespace App\Domain;

use GuzzleHttp\Client;
use App\Data\Recipe;

class Runtasty {
    public function getReceip(int $page = 1, string $terms = '', string $ingredient = ''): array {
        $guzzleClient = new Client(['base_uri' => 'http://www.recipepuppy.com/api/']);
        $guzzleResponse = $guzzleClient->request('GET', '', [
            'query' => [
                'p' => $page,
                'q' => $terms,
                'i' => $ingredient,
            ]
        ]);

        $responseJson = json_decode($guzzleResponse->getBody()->getContents());
        $response = array();
        foreach ($responseJson->results as $result) {
            $recipe = new Recipe();
            $recipe->setTitle($result->title);
            $recipe->setHref($result->href);
            $recipe->setIngredients(explode(',', $result->ingredients));
            $recipe->setThumbnail($result->thumbnail);
            array_push($response, $recipe->toJson());
        }
        return $response;
    }
    
    public function getIngredient(int $page = 1, int $limit = 10): array {
        $guzzleClient = new Client(['base_uri' => 'http://www.recipepuppy.com/api/']);
        $guzzleResponse = $guzzleClient->request('GET', '', [
            'query' => [
                'p' => $page
            ]
        ]);

        $responseJson = json_decode($guzzleResponse->getBody()->getContents());
        $response = array();
        foreach ($responseJson->results as $result) {
            $recipe = new Recipe();
            $recipe->setTitle($result->title);
            $recipe->setHref($result->href);
            $recipe->setIngredients(explode(',', $result->ingredients));
            $recipe->setThumbnail($result->thumbnail);
            foreach ($recipe->getIngredients() as $ingredient){
                if (!in_array($ingredient, $response)){
                    array_push($response, $ingredient);
                    if (count($response) == $limit) {
                        return $response;
                    }
                }
            }
        }
        return $response;
    }
}