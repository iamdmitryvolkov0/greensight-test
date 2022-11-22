<?php

$mailValidation=$_POST['email'];
if(filter_var($mailValidation, FILTER_VALIDATE_EMAIL) && ($_POST['password'] == $_POST['passwordCheck'])){
    try {
        $connectionDatabase = new PDO("mysql:host=localhost;dbname=test", 'root', '');

        if (empty($_POST)){
            exit('Поля не заполнены');
        }

        $query ="INSERT INTO users VALUES(NULL,:firstName,:secondName,:email,:password,:passwordCheck)";
        $msg= $connectionDatabase->prepare($query);
        $msg->execute(
            [   'firstName'=>$_POST['firstName'],
                'secondName'=>$_POST['secondName'],
                'email'=>$_POST['email'],
                'password'=>$_POST['password'],
                'passwordCheck'=>$_POST['passwordCheck']
            ]);
        header("Location:welcome.html");
    }
    catch (PDOException $e){
        echo "error" .$e->getMessage();
    }

}
else if(!filter_var($mailValidation, FILTER_VALIDATE_EMAIL) && ($_POST['password'] != $_POST['passwordCheck'])){
    echo ("Неверный пароль и неверный формат почты");
    header("Location:wrongMailAndPassword.html");
}
else if ($_POST['password'] != $_POST['passwordCheck']){

    echo "Пароли не совпадают";
    header("Location:wrongPassword.html");
}
else if (!filter_var($mailValidation, FILTER_VALIDATE_EMAIL)){
    echo "E-mail адрес '. $mailValidation . ' указан неверно.\n";
    header("Location:wrongEmail.html");
}
