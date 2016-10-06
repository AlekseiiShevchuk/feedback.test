<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ваши отзывы</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <?php if (!isset($_SESSION['logged'])) { ?>
        <a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-user"></span> Sign in</a>
    <?php } ?>
    <?php if (isset($_SESSION['logged'])) { ?>
        <a href="log-out.php"><span class="glyphicon glyphicon-log-in"></span> Log out</a>
    <?php } ?>

    <h3>Отзывы о нашей компании:</h3>
    <hr>
</div>