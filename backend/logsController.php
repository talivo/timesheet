<?php
session_start();
$action = $_POST['action'];

if($action == 'create')
{
    //Validatie
    $date = $_POST['date'];
    if(empty($date))
    {
        $errors[] = "Vul een datum in!";
    }

    $duration = $_POST['duration'];
    if(empty($duration))
    {
        $errors[] = "Vul een duur in!";
    }

    $department = $_POST['department'];
    if(empty($department))
    {
        $errors[] = "Vul een afdeling in!";
    }

    //Evt. errors dumpen
    if(isset($errors))
    {
        var_dump($errors);
        die();
    }

    $user = $_SESSION['user_id'];

    //Query
    //TODO: vijfstappenplan met INSERT-query
    require_once 'conn.php';
    $query = "INSERT INTO logs (user, date, duration, department) 
    VALUES(:user, :date, :duration, :department)";
    $statement = $conn->prepare($query);
    $statement->execute([
        ':user'=> $user,
        ':date'=> $date,
        ':duration'=> $duration,
        ':department'=> $department
    ]);

    header("Location: ../logs/index.php");
    exit;
}

if($action == "update")
{
    $id = $_POST['id'];
    $duration = $_POST['duration']; 

    if(isset($errors)) {
        var_dump($errors);
        die();
    }

    require_once 'conn.php';
    $query = "UPDATE logs SET duration = :duration WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ':duration'=> $duration,
        ':id'=> $id
    ]);

    header('Location: ../logs/index.php?msg=Melding is aangepast');
}

if($action == "delete")
{
    $id = $_POST['id'];
    require_once '../backend/conn.php';
    $query = "DELETE FROM logs WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        'id' => $id
    ]);
    $meldingen = $statement->fetchAll(PDO::FETCH_ASSOC); 

    header('Location: ../logs/index.php?msg=Log verwijderd');
}