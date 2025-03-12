<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="P.RideReadyProductoverview.css">
</head>

<body class="homepage-body">
    <?php include 'P.RideReadyHeader.php'; ?>
    <!-- Start Welcome Section -->
    <div class="teaser-wrapper">
        <h2 class="landingpage-title">⚜️Willkommen bei Ride Ready⚜️</h2>
        <video autoplay muted playsinline class="teaser-titlepicture-image">
            <source src="Images/Landingpage/Titlepicture.mp4" type="video/mp4">
        </video>

        <!-- Start Teaser Section -->
        <h2 class="landingpage-title">Mobilität, die zu Ihnen passt – Entdecken Sie unsere Top-Mietwagenangebote!</h2>
        <div class="teaser-grid">
            <div>
                <img src="Images/Landingpage/Mini-Cabrio.LP.webp" alt="Cabrios" class="teaser-vehicle-image">
                <p>Cabrios</p>
            </div>
            <div>
                <img src="Images/Landingpage/Mercedes-GLS.LP.webp" alt="SUVs" class="teaser-vehicle-image">
                <p>SUVs</p>
            </div>
            <div>
                <img src="Images/Landingpage/BMW-M1.LP.webp" alt="Limousinen" class="teaser-vehicle-image">
                <p>Coupés</p>
            </div>
            <div>
                <img src="Images/Landingpage/VW-Passat.LP.webp" alt="Combis" class="teaser-vehicle-image">
                <p>Combis</p>
            </div>
            <div>
                <img src="Images/Landingpage/VW-Sharan.LP.webp" alt="Mehrsitzer" class="teaser-vehicle-image">
                <p>Mehrsitzer</p>
            </div>
            <div>
                <img src="Images/Landingpage/Mercedes-E-Klasse.LP.webp" alt="Coupés" class="teaser-vehicle-image">
                <p>Limousinen</p>
            </div>
        </div>
    </div>

    <!-- Start Recommendation Section -->
    <div class="recommendations-container">
        <h2 class="landingpage-title">Unsere Top Empfehlungen:</h2>
        <div class="recommendations-wrapper">
            <div class="recommendation-card">
                <img src="Images/Landingpage/Mercedes-SKlasse.LP.webp" alt="Mercedes-Benz S500L" class="recommendation-image">
                <div class="recommendation-text">Jetzt Neu bei uns: Der Mercedes-Benz S500L</div>
            </div>
            <div class="recommendation-card">
                <img src="Images/Landingpage/VW-Golf.LP.webp" alt="VW Polo" class="recommendation-image">
                <div class="recommendation-text">Besonders Günstig: Der VW Polo</div>
            </div>
        </div>
    </div>

    <!-- Start Feedback Section -->
    <div class="feedback-container">
        <h2 class="landingpage-title">Unsere Kundenbewertungen:</h2>
        <p class="feedback-logo"> <img class="feedback-logo" src="Images/Logo.png" alt="Ride Ready Logo"></p>
        <p class="feedback-rating">★★★★☆</p>
        <!-- BUG mit CSS!!!! -->
        <p style="margin-top: -30px; text-align:center; color:#123472;">aus 312 Bewertungen</p>
        <div class="feedback-reviews">
            <div class="feedback-review">
                <div class="feedback-user">
                    <div class="feedback-user-icon" style="background: green;">AR</div>
                    Adorjan Rieck
                </div>
                <p class="feedback-star">★★★★★</p>
                <p class="feedback-text">Perfekte Autovermietung! Freundliches Personal, transparente Preise und ein sauberes, zuverlässiges Auto – besser geht's nicht!</p>
            </div>
            <div class="feedback-review">
                <div class="feedback-user">
                    <div class="feedback-user-icon" style="background: blue;">SA</div>
                    Salwa Alkiani
                </div>
                <p class="feedback-star">★★★★★</p>
                <p class="feedback-text">Wow, great service and good cars!</p>
            </div>
            <div class="feedback-review">
                <div class="feedback-user">
                    <div class="feedback-user-icon" style="background: red;">JR</div>
                    Johannes Ripp
                </div>
                <p class="feedback-star">★★★★☆</p>
                <p class="feedback-text">Das Auto war in einem sehr gutem Zustand und die Abwicklung verlief problemlos. Ein kleiner Verbesserungspunkt wäre eine etwas schnellere Fahrzeugübergabe.</p>
            </div>
            <div class="feedback-review">
                <div class="feedback-user">
                    <div class="feedback-user-icon" style="background: orange;">JD</div>
                    Josef Dreischulte
                </div>
                <p class="feedback-star">★★★★★</p>
                <p class="feedback-text">Erstklassiger Webauftritt dieser Autovermietung, 1A!</p>
            </div>
        </div>
    </div>

    <?php include 'P.RideReadyFooter.php'; ?>
</body>
</html>
