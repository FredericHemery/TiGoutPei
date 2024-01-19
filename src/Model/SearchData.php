<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class SearchData{
    /** @var string|null
     * */
     #[Assert\Regex('/^[a-zA-Z0-9\s\']+$/u',message: "Veuillez ne pas entrer de caracteres speciaux")]
    public ?string $mots = '';
}