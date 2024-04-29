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
    <title>TimeSheet / Logs</title>
    <?php require_once '../head.php'; ?>
</head>

<body>

    <?php require_once '../header.php'; ?>
    <div class="container">

        <h1>TimeSheet / Logs</h1>
        <a href="create.php">Nieuwe log maken &gt;</a>

        <?php
        require_once '../backend/conn.php';
        $query = "SELECT * FROM logs ORDER BY date DESC";
        $statement = $conn->prepare($query);
        $statement->execute();
        $logs = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <table>
            <tr>
                <th>Duur</th>
                <th>Afdeling</th>
                <th>Datum &downarrow;</th>
                <th>Gebruikers-id</th>
                <th>Aanpassen</th>
            </tr>
            <?php foreach($logs as $log): ?>
                <tr>
                    <td><?php echo $log['duration']; ?>u</td>
                    <td><?php echo $log['department']; ?></td>
                    <td><?php echo $log['date']; ?></td>
                    <td>#<?php echo $log['user']; ?></td>
                    <td><a href="update.php?id=<?php echo $log['id']; ?>">aanpassen</a></td>
                </tr>
            <?php endforeach; ?>
        </table>


    </div>

</body>

</html>
