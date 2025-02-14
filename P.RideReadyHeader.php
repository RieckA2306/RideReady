<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride Ready - Header</title>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* Allgemeines Styling */
        .header-body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: white;
        }
        
        /* Header Styling */
        .header {
            display: flex;
            flex-direction: column;
            padding: 20px;
            background-color: #123472;
            position: sticky;
            top:0;
            
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo img {
            height: 40px; /* Platzhalter für dein Logo */
        }
        
        .logo h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }
        
        .search-box {
            display: flex;
            gap: 10px;
            background: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: -65px;
            margin:auto
            
        }
        
        .search-box select, .search-box input, .search-box button {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        .search-box button {
            background-color: #80BFFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        
        .search-box button:hover {
            background-color: #123472;
        }
        /* Ändert die Hintergrundfarbe des ausgewählten Datums */
        .flatpickr-day.selected, 
        .flatpickr-day.selected:hover {
            background: #80BFFF !important;
            border-color: #80BFFF !important;
            color: white !important;
        }

        /* Falls mehrere Tage in einem Bereich ausgewählt werden können */
        .flatpickr-day.inRange {
        background: #B3DAFF !important;
        color: white !important;

        
            }
        .hamburger-button {
            margin-left: auto;      /* Schiebt den Button bei Bedarf nach rechts */
            background-color: white;
            border: none;
            border-radius: 8px;
            width: 40px;
            height: 40px;
            cursor: pointer;
            align-items: right;
        }

        .hamburger-button span {
            display: block;
            width: 20px;
            height: 3px;
            background-color: #999;
            margin: 4px auto;
        }
    </style>
</head>
<body class="header-body">
    <header class="header">
        <div class="logo"> <!-- Platzhalter für dein Logo -->
            <P style="align-items:left; width:100%"><img src="logo.png" alt="Ride Ready Logo"></p> <!-- Hier kannst du dein Bild einfügen -->
            <button class="hamburger-button">
        <span></span>
        <span></span>
        <span></span>
        </button>
        </div>
    
        <div class="search-box" style="margin-top: -65px;">
            <!-- Dropdown für Abholort -->
            <select name="city" id="abholort">
                <option>Abholort</option> <!-- Check, das Abholort nicht ausgewählt ist, es muss eine Stadt sein -->
                <option value="Berlin">Berlin</option>
                <option value="Bielefeld">Bielefeld</option>
                <option value="Bochum">Bochum</option>
                <option value="Bremen">Bremen</option>
                <option value="Dortmund">Dortmund</option>
                <option value="Dresden">Dresden</option>
                <option value="Freiburg">Freiburg</option>
                <option value="Hamburg">Hamburg</option>
                <option value="Köln">Köln</option>
                <option value="Leipzig">Leipzig</option>
                <option value="München">München</option>
                <option value="Nürnberg">Nürnberg</option>
                <option value="Paderborn">Paderborn</option>
                <option value="Rostock">Rostock</option>
            </select>
            <!-- Kalenderfelder -->
         <input type="text" id="abholdatum" placeholder="Abholdatum">
         <input type="text" id="rueckgabedatum" placeholder="Rückgabedatum">
         <button id="suchen">Suchen</button>
        </div>
    </header>
    
        <!-- Flatpickr JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let abholDatePicker = flatpickr("#abholdatum", {
                dateFormat: "d.m.Y",  
                minDate: "today",      
                onChange: function(selectedDates, dateStr) {
                    rueckgabeDatePicker.set("minDate", dateStr);
                }
            });

            let rueckgabeDatePicker = flatpickr("#rueckgabedatum", {
                dateFormat: "d.m.Y",
                minDate: "today",
            });
        });
    </script>

</body>
</html>
