<?php

namespace Task\Core\Messages\User;

class UserStatus
{
    static function createUserSuccess(): string { return __('Użytkownik pomyślne stworzony');}

    static function loginUserSuccess(): string { return __('Użytkownik pomyślne zalogowany');}

    static function emailAndPasswordNotMatch(): string { return __('Adres e-mail i hasło nie zgadzają się z naszymi danymi.');}

    static function userNotExists(): string { return __('Użytkownik nie istnieje.');}
}