<?php

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


