<?php require_once 'backend/config.php';
?>

<header>
    <div class="container">
        <nav>
            <a href="<?php echo $base_url; ?>/index.php">Home</a> |
            <a href="<?php echo $base_url; ?>/logs/index.php">Logs</a>
        </nav>
        <nav>                
            <?php if(!isset($_SESSION['user_id'])): ?>
                <p><a href="<?php echo $base_url; ?>/login.php">Inloggen</a></p>
            <?php else: ?>
                <p>Hallo <?php echo $_SESSION['user_name']; ?>&nbsp;|&nbsp;</p>
                <p><a href="<?php echo $base_url; ?>/logout.php">Uitloggen</a></p>
            <?php endif; ?>
        </nav>
    </div>
</header>