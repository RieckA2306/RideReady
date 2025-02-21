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

        // Anzeigen der Session-Variablen aus dem Header
        $city = $_SESSION['city'] ?? 'Kein Abholort gesetzt';
        $abholdatum = $_SESSION['abholdatum'] ?? 'Kein Abholdatum gesetzt';
        $rueckgabedatum = $_SESSION['rueckgabedatum'] ?? 'Kein Rückgabedatum gesetzt';
        $username= $_SESSION["benutzername"];

        echo '<div class="bg-white p-4 shadow-md rounded-md">';
        echo '<p><strong>City:</strong> ' . htmlspecialchars($city) . '</p>';
        echo '<p><strong>Abholdatum:</strong> ' . htmlspecialchars($abholdatum) . '</p>';
        echo '<p><strong>Rückgabedatum:</strong> ' . htmlspecialchars($rueckgabedatum) . '</p>';
        echo '<p><strong>username:</strong> ' . htmlspecialchars($username) . '</p>';
        echo '</div>';

        ?>

        <div class="mt-4">
            <a href="session_reset.php" class="bg-red-500 text-white px-4 py-2 rounded">Session zurücksetzen</a>
        </div>
    </div>
</body>
</html>
