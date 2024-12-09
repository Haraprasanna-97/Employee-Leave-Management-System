<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        include "constants.php";
        echo $APPNAME;
    ?> - Home Page</title>
    <link rel="stylesheet" href="./CSS/home.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <main>
            <h1><?php echo $APPNAME; ?></h1>
            <p><?php echo $description ?></p>
        </main>
    </div>
</body>
</html>