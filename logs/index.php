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
        if(empty($_GET['department'])) {
            $query = "SELECT * FROM logs ORDER BY date DESC";
            $statement = $conn->prepare($query);
            $statement->execute();
        } else {
            $query = "SELECT * FROM logs WHERE department = :department ORDER BY date DESC ";
            $statement = $conn->prepare($query);
            $statement->execute([
                ':department'=> $_GET['department']
            ]);            
        }
        $logs = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="logs-en-filter">
            <p>Aantal logs: <strong><?php echo count($logs); ?></strong></p>
            <form method="GET">
                <select name="department" id="department">
                    <option value="">- filter op adfeling -</option>
                    <option value="attracties">Attracties (gastheer/gastvrouw)</option>
                    <option value="horeca">Restaurants en cafes</option>
                    <option value="techniek">Technische dienst</option>
                    <option value="groen">Groenbeheer</option>
                    <option value="service">Klantenservice</option>
                    <option value="humanresources">Personeel en HR</option>
                    <option value="inkoop">Inkoop</option>
                </select>
                <input type="submit" value="filter">
            </form>
        </div>


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
