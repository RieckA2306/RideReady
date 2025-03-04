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
        $pickupdate = $_SESSION['pickupdate'] ?? 'Kein Abholdatum gesetzt';
        $returndate = $_SESSION['returndate'] ?? 'Kein Rückgabedatum gesetzt';
        $username = $_SESSION['benutzername'] ?? 'Kein Nutzernamen gesetzt';
        $count=$_SESSION['cardcount'] ?? 'Kein count gesetzt';
        $car_id=$_SESSION['bookingcar_id'] ?? 'kein auot ims staging';
        $account_id=$_SESSION["account_id"] ??'     ';
        $bookingstart=$_SESSION['bookingstart']??' ';


        // HTML-Ausgabe im gleichen Stil
        echo '<div class="bg-white p-4 shadow-md rounded-md">';
        echo '<p><strong>City:</strong> ' . htmlspecialchars($city) . '</p>';
        echo '<p><strong>Abholdatum:</strong> ' . htmlspecialchars($pickupdate) . '</p>';
        echo '<p><strong>Rückgabedatum:</strong> ' . htmlspecialchars($returndate) . '</p>';
        echo '<p><strong>Username:</strong> ' . htmlspecialchars($username) . '</p>';
        echo '<p><strong>Hersteller:</strong> ' . htmlspecialchars($manufacturer) . '</p>';
        echo '<p><strong>Sitze:</strong> ' . htmlspecialchars($seats) . '</p>';
        echo '<p><strong>Türen:</strong> ' . htmlspecialchars($doors) . '</p>';
        echo '<p><strong>Getriebe:</strong> ' . htmlspecialchars($transmission) . '</p>';
        echo '<p><strong>Alter:</strong> ' . htmlspecialchars($age) . '</p>';
        echo '<p><strong>Typ:</strong> ' . htmlspecialchars($type) . '</p>';
        echo '<p><strong>Antrieb:</strong> ' . htmlspecialchars($drive) . '</p>';
        echo '<p><strong>Klima:</strong> ' . ($climate ? 'true' : 'false') . '</p>';
        echo '<p><strong>GPS:</strong> ' . ($gps ? 'true' : 'false') . '</p>';
        echo '<p><strong>Typ:</strong> ' . htmlspecialchars($count) . '</p>';
        echo '<p><booking>Typ:</strong> ' . htmlspecialchars($car_id) . '</p>';
        echo '<p><strong>account:</strong> ' . htmlspecialchars($account_id) . '</p>';
        echo '<p><strong>bookingstart:</strong> ' . htmlspecialchars($bookingstart) . '</p>';
        echo '</div>';
        ?>

        <div class="mt-4">
            <a href="session_reset.php" class="bg-red-500 text-white px-4 py-2 rounded">Session zurücksetzen</a>
        </div>
    </div>
</body>
</html>