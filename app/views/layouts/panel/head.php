<!-- Head Dinámico para evitar duplicidad de código -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($head['title']) ? htmlspecialchars($head['title']) : 'Mister PC Boteo' ?></title>
    <link href="<?= BASE_URL ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="<?= BASE_URL ?>css/paneles.css" rel="stylesheet">
</head>
