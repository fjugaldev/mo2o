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
            $recipe->setIngredients($result->ingredients);
            $recipe->setThumbnail($result->thumbnail);
            array_push($response, $recipe->toJson());
        }
        return $response;
    }

    public function getIngredient(int $page = 1, int $limit = 10): array {
        $response = array();
        while (count($response) < $limit) {
            $guzzleClient = new Client(['base_uri' => 'http://www.recipepuppy.com/api/']);
            $guzzleResponse = $guzzleClient->request('GET', '', [
                'query' => [
                    'p' => $page
                ]
            ]);

            $responseJson = json_decode($guzzleResponse->getBody()->getContents());
            foreach ($responseJson->results as $result) {
                $recipe = new Recipe();
                $recipe->setTitle($result->title);
                $recipe->setHref($result->href);
                $recipe->setIngredients($result->ingredients);
                $recipe->setThumbnail($result->thumbnail);
                foreach ($recipe->getIngredients() as $ingredient) {
                    if (!in_array($ingredient, $response)) {
                        array_push($response, $ingredient);
                        if (count($response) == $limit) {
                            return $this->sortArray($response);
                        }
                    }
                }
            }
            $page++;
        }
        return $this->sortArray($response);
    }

    private function sortArray(array $array): array {
        sort($array, SORT_STRING);
        return $array;
    }

}
