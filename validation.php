<?php

    function validate(): bool
    {
        if (empty($_POST)) {
        exit('Поля не заполнены');
        }

        $mailValidation = $_POST['email'];
        if (!filter_var($mailValidation, FILTER_VALIDATE_EMAIL)) {
            echo "<pre> E-mail адрес '. $mailValidation . ' указан неверно.\n";
            return false;
        }

        if ($_POST['password'] != $_POST['passwordCheck']) {
            echo "<pre> Пароли не совпадают";
            return false;
        }
    return true;
}

