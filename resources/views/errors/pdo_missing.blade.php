<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Service Unavailable</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; color:#333; text-align:center; padding:6rem; }
        h1 { font-size:2rem; margin-bottom:0.5rem; }
        p { color:#666 }
        code { background:#f5f5f5; padding:0.2rem 0.4rem; border-radius:4px; }
    </style>
</head>
<body>
    <h1>Service Unavailable (503)</h1>
    <p>{{ $message ?? 'A required PHP PDO driver for the configured database is not available.' }}</p>
    <p>Please install the appropriate PHP extension (for MySQL: <code>pdo_mysql</code>), then restart PHP and try again.</p>
</body>
</html>