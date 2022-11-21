<?php

namespace Task\Core\Messages\Picture;

class PictureErrorStatus
{
    static function pictureNotFound(): string { return __('Nie znaleziono Twojego obrazka.');}

    static function picturesWithNameNotFound($name): string { return __('Nie znaleziono obrazków z nazwą: :name', ['name' => $name]);}

    static function pictureAddWithSuccess(): string { return __('Pomyślnie dodano obrazek');}
}