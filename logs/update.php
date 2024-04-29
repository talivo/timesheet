<?php
    session_start();
    if(!isset($_SESSION['user_id'])) {
        $msg = "Je moet eerst inloggen";
        header("Location: ../login.php?msg=".$msg);
        die;
} 
?>

<!doctype html>
<html lang="nl">
<head>
    <title>TimeSheet / Logs / Edit</title>
    <?php require_once '../head.php'; ?>
</head>
<body>

    <?php
    require_once '../backend/conn.php';
    $id = $_GET['id'];
    $query = "SELECT * FROM logs WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([":id" => $id]);
    $log = $statement->fetch(PDO::FETCH_ASSOC);
    ?>

    <?php require_once '../header.php'; ?>
    <div class="container">

        <h1>TimeSheet / Logs / Update</h1>

        <form action="../backend/logsController.php" method="POST">
            <div class="form-group">
                <label for="date">Datum:</label>
                <?php echo $log['date']; ?>
            </div>
            <div class="form-group">
                <label for="duration">Duur (uren):</label>
                <input type="number" name="duration" id="duration" class="form-input" value="<?php echo $log['duration']; ?>">
            </div>
            <div class="form-group">
                <label for="department">Afdeling:</label>
                <?php echo $log['department']; ?>
            </div>
            <input type="submit" value="Log aanpassen">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        </form>
        <hr>
        <form action="../backend/logsController.php" method="POST">
            <div class="form-group">
                <input type="submit" value="Verwijderen">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
            </div>
        </form>
    </div>
</body>
</html>