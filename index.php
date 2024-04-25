<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Health Guardian</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
        }
        .footer {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <section class="home content">
        <div class="container text-center">
            <h1>Welcome to Health Guardian</h1>
            <p class="display-4">We are here to assure your health</p>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>
