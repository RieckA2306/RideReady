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

        .status-bar {
            background-color: #222;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
        }

        .filter-bar {
            background-color: #f9f9f9;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px;
            width: 90%;
            max-width: 1300px;
            margin-left: auto;
            margin-right: auto;
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
            border-radius: 12px;
            border: 1px solid #ccc;
            width: 150px;
            text-align: center;
        }
        .filter-bar button {
            background-color: #123472;
            color: white;
            border: none;
            cursor: pointer;
        }
        .filter-bar button:hover {
            background-color:  gold;
            color: black;
        }
        .filter-bar a {
            text-align: center;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }


    </style>
</head>
<body>
  

    <div class="filter-bar">
        <div class="filter-group">
            <label for="hersteller">Hersteller:</label>
            <select name="manufacturer" id="hersteller" class="filter-group">
                <option value="">alle</option>
                <?php
                $a_manufacturers = ["Berlin", "Bielefeld", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock"];
                foreach ($a_manufacturers as $manufacturerOption) {
                    $selected = ($manufacturerOption == $manufacturer) ? 'selected' : '';
                    echo "<option value='$manufacturerOption' $selected>$manufacturerOption</option>";
                }
                ?>
            </select>
        </div>

        <div class="filter-group">
            <label for="seats">Sitze:</label>
            <select name="seats" id="seats" class="filter-group">
                <option value="">alle</option>
                <?php
                $a_seats = ["Berlin", "Bielefeld", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock"];
                foreach ($a_seats as $seatsOption) {
                    $selected = ($seatsOption == $seats) ? 'selected' : '';
                    echo "<option value='$seatsOption' $selected>$seatsOption</option>";
                }
                ?>
            </select>
        </div>

        <div class="filter-group">
            <label for="doors">Türen:</label>
            <select name="doors" id="doors" class="filter-group">
                <option value="">alle</option>
                <?php
                $a_doors = ["Berlin", "Bielefeld", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock"];
                foreach ($a_doors as $doorsOption) {
                    $selected = ($doorsOption == $doors) ? 'selected' : '';
                    echo "<option value='$doorsOption' $selected>$doorsOption</option>";
                }
                ?>
            </select>
        </div>

        <div class="filter-group">
            <label for="transmission">Getriebe:</label>
            <select name="transmission" id="transmission" class="filter-group">
                <option value="">alle</option>
                <?php
                $a_transmission = ["Berlin", "Bielefeld", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock"];
                foreach ($a_transmission as $transmissionOption) {
                    $selected = ($transmissionOption == $transmission) ? 'selected' : '';
                    echo "<option value='$transmissionOption' $selected>$transmissionOption</option>";
                }
                ?>
            </select>
        </div>


        <div class="filter-group"><label>Klima:</label><input type="checkbox"></div>
        <div class="filter-group"><label>GPS:</label><input type="checkbox"></div>

        <div class="filter-group">
            <label for="age">Alter:</label>
            <select name="age" id="age" class="filter-group">
                <option value="">alle</option>
                <?php
                $a_age = ["Berlin", "Bielefeld", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock"];
                foreach ($a_age as $ageOption) {
                    $selected = ($ageOption == $age) ? 'selected' : '';
                    echo "<option value='$ageOption' $selected>$ageOption</option>";
                }
                ?>
            </select>
        </div>

        <div class="filter-group">
            <label for="type">Typ:</label>
            <select name="type" id="type" class="filter-group">
                <option value="">alle</option>
                <?php
                $a_type = ["Berlin", "Bielefeld", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock"];
                foreach ($a_type as $typeOption) {
                    $selected = ($typeOption == $type) ? 'selected' : '';
                    echo "<option value='$typeOption' $selected>$typeOption</option>";
                }
                ?>
            </select>
        </div>

        <div class="filter-group">
            <label for="drive">Antrieb:</label>
            <select name="drive" id="drive" class="filter-group">
                <option value="">alle</option>
                <?php
                $a_drive = ["Berlin", "Bielefeld", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock"];
                foreach ($a_drive as $driveOption) {
                    $selected = ($driveOption == $drive) ? 'selected' : '';
                    echo "<option value='$driveOption' $selected>$driveOption</option>";
                }
                ?>
            </select>
        </div>


        <div class="filter-group"><label>Preis bis:</label><select><option>alle</option></select></div>
        <div class="filter-group"><label>Sortierung:</label><select><option>Preis ↑</option></select></div>
        <div class="filter-group"><button>Filtern</button></div>
        <div class="filter-group"><a href="#">Filter und Sortierung zurücksetzen</a></div>
    </div>

</body>
</html>
