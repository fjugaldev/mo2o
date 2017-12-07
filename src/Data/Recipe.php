<?php

namespace App\Data;

class Recipe {

    private $title;
    private $href;
    private $ingredients;
    private $thumbnail;

    public function __construct() {
        $this->title = '';
        $this->href = '';
        $this->ingredients = array();
        $this->thumbnail = '';
    }

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

    public function setTitle(string $title) {
        $this->title = $title;
    }

    public function setHref(string $href) {
        $this->href = $href;
    }

    public function setIngredients(string $ingredients) {
        $this->ingredients = explode(', ', $ingredients);
    }

    public function setThumbnail(string $thumbnail) {
        $this->thumbnail = $thumbnail;
    }

    public function toJson(): array {
        return get_object_vars($this);
    }

}
