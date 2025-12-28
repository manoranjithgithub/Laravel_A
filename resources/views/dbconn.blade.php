<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel & MYSQL DB Connection</title>
</head>
<body>
    <div>
        <?php
        if (DB::connection()->getPdo()) {
            echo "Connected to the database successfully!";
        } else {
            echo "Failed to connect to the database.";
        }
        
        ?>

    </div>
</body>
</html>