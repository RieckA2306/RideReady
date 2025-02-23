<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktübersicht</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e5e5e5;
            margin: 0;
            padding: 0;
            width: auto;
        }

        .filter-bar {
            background-color: #f9f9f9;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            width: 90%;
            max-width: 1300px;
            align-items: center;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .filter-bar select, .filter-bar input, .filter-bar button {
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 150px;
            text-align: center;
        }

        .filter-bar button {
            background-color: #80BFFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        .filter-bar button:hover {
            background-color: #123472;
        }
    </style>
</head>
<body>
  

    <div class="filter-bar">

        <?php
            require_once 'Functions.php';

            // Alle Arrays an einer Stelle definiert:
            $a_manufacturers = ["Audi", "BMW", "Mercedes", "Volkswagen"];
            $a_seats = ["2", "4", "5", "7", "9"];
            $a_doors = ["Berlin", "Bielefeld", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock"];
            $a_transmission = ["Berlin", "Bielefeld", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock"];
            $a_age = ["Berlin", "Bielefeld", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock"];
            $a_type = ["Berlin", "Bielefeld", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock"];
            $a_drive = ["Berlin", "Bielefeld", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock"];

            // Dynamische Funktionsaufrufe:
            renderFilterGroup('Hersteller', 'manufacturer', $a_manufacturers, $manufacturer ?? '');
            renderFilterGroup('Sitze', 'seats', $a_seats, $seats ?? '');
            renderFilterGroup('Türen', 'doors', $a_doors, $doors ?? '');
            renderFilterGroup('Getriebe', 'transmission', $a_transmission, $transmission ?? '');
        ?>  
            <div class="filter-group ">
                <div>
                    <label for="climate">Klima:</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" name="climate" id="climate" 
                        <?php echo isset($climate) && $climate ? 'checked' : ''; ?>>
                </div>
            </div>

            <div class="filter-group ">
                <div>
                    <label for="gps">GPS:</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" name="gps" id="gps" 
                        <?php echo isset($gps) && $gps ? 'checked' : ''; ?>>
                </div>
            </div>
        
        <?php
            renderFilterGroup('Alter', 'age', $a_age, $age ?? '');
            renderFilterGroup('Typ', 'type', $a_type, $type ?? '');
            renderFilterGroup('Antrieb', 'drive', $a_drive, $drive ?? '');
        ?>


        <div class="filter-group"><label>Preis bis:</label><select><option>alle</option></select></div>
        <div class="filter-group"><label>Sortierung:</label><select><option>Preis ↑</option></select></div>
        <!-- Buttons für Filtern und Zurücksetzen -->
        <div class="filter-group">
            <button type="submit" name="filter">Filtern</button>
        </div>
        <div class="filter-group">
            <button type="submit" name="reset" value="1">Filter zurücksetzen</button>
        </div>
    </div>

</body>
</html>
