<?php

namespace App\Domain;

use GuzzleHttp\Client;
use App\Data\Recipe;

class Runtasty {
    public function getReceip(): array {
        $guzzleClient = new Client(['base_uri' => 'http://www.recipepuppy.com/api/']);
        $guzzleResponse = $guzzleClient->request('GET', '', [
            'query' => ['p' => 1]
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
}