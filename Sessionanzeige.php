<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Viewer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Session Variablen anzeigen</h1>

        <?php
        session_start();

        // Korrekte Session-Variablen verwenden
        // Session-Variablen laden mit Standardwerten
        $manufacturer = $_SESSION['manufacturer'] ?? 'Kein Hersteller gesetzt';
        $seats = $_SESSION['seats'] ?? 'Keine Sitzzahl gesetzt';
        $doors = $_SESSION['doors'] ?? 'Keine Türanzahl gesetzt';
        $transmission = $_SESSION['transmission'] ?? 'Kein Getriebe gesetzt';
        $age = $_SESSION['age'] ?? 'Kein Alter gesetzt';
        $type = $_SESSION['type'] ?? 'Kein Typ gesetzt';
        $drive = $_SESSION['drive'] ?? 'Kein Antrieb gesetzt';
        $climate = $_SESSION['climate'] ?? false;
        $gps = $_SESSION['gps'] ?? false;
        $city = $_SESSION['city'] ?? 'Kein Abholort gesetzt';
        $abholdatum = $_SESSION['abholdatum'] ?? 'Kein Abholdatum gesetzt';
        $rueckgabedatum = $_SESSION['rueckgabedatum'] ?? 'Kein Rückgabedatum gesetzt';
        $username = $_SESSION['benutzername'] ?? 'Kein Nutzernamen gesetzt';
        
   
   

        // HTML-Ausgabe im gleichen Stil
        echo '<div class="bg-white p-4 shadow-md rounded-md">';
        echo '<p><strong>City:</strong> ' . htmlspecialchars($city) . '</p>';
        echo '<p><strong>Abholdatum:</strong> ' . htmlspecialchars($pickupdate) . '</p>';
        echo '<p><strong>Rückgabedatum:</strong> ' . htmlspecialchars($returndate) . '</p>';
        echo '<p><strong>Username:</strong> ' . htmlspecialchars($username) . '</p>';
        echo '</div>';
        ?>

        <div class="mt-4">
            <a href="session_reset.php" class="bg-red-500 text-white px-4 py-2 rounded">Session zurücksetzen</a>
        </div>
    </div>
</body>
</html>