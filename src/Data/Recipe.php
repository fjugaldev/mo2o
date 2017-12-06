<?php

namespace App\Data;

class Recipe {

    private $title;
    private $href;
    private $ingredients;
    private $thumbnail;

    public function getTitle(): string {
        return $this->title;
    }

    public function getHref(): string {
        return $this->href;
    }

    public function getIngredients(): array {
        return $this->ingredients;
    }

    public function getThumbnail(): string {
        return $this->thumbnail;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setHref($href) {
        $this->href = $href;
    }

    public function setIngredients($ingredients) {
        $this->ingredients = $ingredients;
    }

    public function setThumbnail($thumbnail) {
        $this->thumbnail = $thumbnail;
    }

}
