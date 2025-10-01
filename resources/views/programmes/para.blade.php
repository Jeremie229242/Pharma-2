<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Programme des Pharmacies de Garde - Pointe-Noire</title>
  <link rel="stylesheet" href="style.css">
  <style>

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  line-height: 1.6;
  background: #f0f0f0;
  color: #333;
}

.container {
  display: flex;
  flex-wrap: wrap;
}

/* --- Colonne gauche --- */
.left-panel {
    flex: 1;
  min-width: 280px;
  background: url("building.jpg") no-repeat center bottom;
  background-size: cover;
  color: #444;
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 20px;
}

.left-panel h2 {
  color: #006400;
  font-size: 1.5rem;
  margin: 10px 0;
}

.left-panel span {
  color: #c00;
}
.left-panel::before {
  content: "";
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(255,255,255,0.85);
  z-index: 1;
}
.left-panel > * {
  position: relative;
  z-index: 2;
  text-align: center;
}

.date-text {
  font-size: 0.9rem;
  margin: 10px 0;
}

.building img {
  width: 100%;
  max-height: 250px;
  object-fit: cover;
  border-radius: 6px;
}

/* --- Colonne droite --- */
.right-panel {
  flex: 3;
  min-width: 300px;
  padding: 20px;
}

.title {
  text-align: center;
  margin-bottom: 20px;
}

.title h1 {
  font-size: 1.4rem;
  color: #004080;
}

.subtitle {
  font-size: 1rem;
  color: #c00;
  font-weight: bold;
  margin-top: 5px;
}

.pharmacies {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
}

.pharmacies h3 {
  color: #004080;
  font-size: 1rem;
  margin-bottom: 8px;
  border-bottom: 2px solid #eee;
}

.pharmacies ul {
  list-style: none;
}

.pharmacies li {
  margin-bottom: 6px;
  font-size: 0.9rem;
}

.red {
  color: #c00;
  font-weight: bold;
}

.footer {
  text-align: center;
  margin-top: 20px;
  font-size: 0.9rem;
  color: #444;
}

.footer img {
  max-width: 150px;
  margin-bottom: 10px;
}

</style>
</head>
<body>
  <div class="container">
    <!-- Colonne gauche -->
    <aside class="left-panel">
      <div class="indep-box">
        <div class="map-logo">
          <img src="congo-map.png" alt="Carte Congo">
        </div>
        <h2>65 ans d’indépendance<br><span>1960 - 2025</span></h2>
        <p class="date-text">Ce 15 Août 2025<br>La République du Congo<br>célèbre son 65e Anniversaire<br>d’indépendance</p>
        <div class="building">
          <img src="building.jpg" alt="Immeuble Congo">
        </div>
      </div>
    </aside>

    <!-- Colonne droite -->
    <main class="right-panel">
      <header class="title">
        <h1>PROGRAMME DES PHARMACIES<br>DE GARDE DE POINTE-NOIRE</h1>
        <p class="subtitle">Du Lundi 11 Août 2025 au Dimanche 17 Août 2025</p>
      </header>

      <section class="pharmacies">
        <div class="col">
          <h3>ARRD. N° 1<br>E.P LUMUMBA</h3>
          <ul>
            <li><span class="red">CROIX DU SUD</span> (Centre-ville face direction Airtel)</li>
            <li><span class="red">C.O.B</span> (Face la morgue municipale)</li>
            <li><span class="red">PARAFFI</span> (Grand marché ligne 8)</li>
            <li><span class="red">MÈRE THERESA</span> (Enceinte Brasco KM4)</li>
            <li><span class="red">CHATEAU</span> (Carrefour château OCH)</li>
            <li><span class="red">NUPTIA</span> (Grand marché Av. de la Révolution)</li>
            <li><span class="red">JOACHIM</span> (Vers Base Industrielle Total)</li>
          </ul>
        </div>

        <div class="col">
          <h3>ARRD. N° 2<br>MYOU-MYOU</h3>
          <ul>
            <li><span class="red">BAYONNE</span> (Arrêt Kitoko Daniel)</li>
            <li><span class="red">ROYAL DE NORAH</span> (Rond point Mavata)</li>
            <li><span class="red">GOTCH</span> (Songolo vers hôtel la Concorde)</li>
            <li><span class="red">ALEXANDRA</span> (Ligne 15 carrefour MARALA)</li>
          </ul>

          <h3>ARRD. N° 3<br>TIE-TIE</h3>
          <ul>
            <li><span class="red">7/7 DE DANY</span> (Ligne 15, 7/7 tié-tié)</li>
            <li><span class="red">DE DIEU</span> (Contre rails fond tié-tié)</li>
            <li><span class="red">SAVON</span> (Arrêt socaf vers arrêt tié-tié)</li>
            <li><span class="red">BANQUE DE VIE</span> (Voungou banque de vie)</li>
          </ul>
        </div>

        <div class="col">
          <h3>ARRD. N° 4<br>LOANDJILI</h3>
          <ul>
            <li><span class="red">MAKOSSO ST KISITO</span> (Face église St Kisito ligne 8)</li>
            <li><span class="red">PIN</span> (Mbota rock carrefour Etraba)</li>
          </ul>

          <h3>ARRD. N° 5<br>MONGO-MPOUKOU</h3>
          <ul>
            <li><span class="red">FAUBOURG</span> (Loandjili Marché Faubourg)</li>
            <li><span class="red">MARCHÉ SIAFOUMOU</span> (Face marché Siafoumou)</li>
            <li><span class="red">ALMA</span> (...) </li>
            <li><span class="red">KORIA</span> (...) </li>
            <li><span class="red">LA PATIENCE</span> (Face école primaire Songolo)</li>
            <li><span class="red">ONE BLANCHI</span> (Arrêt Rebecca Nkouikou)</li>
            <li><span class="red">LA BIENFAISANCE</span> (Vindoulou arrêt le sapin)</li>
          </ul>
        </div>

        <div class="col">
          <h3>ARRD. N° 6<br>NGOYO</h3>
          <ul>
            <li><span class="red">NGOYO</span> (Ngoyo arrêt station Puma)</li>
          </ul>

          <h3>DISTRICT DE<br>TCHIAMBA-NZASSI</h3>
          <ul>
            <li><span class="red">PHARMACIE DE LA FRONTIÈRE</span> (Route de la frontière Cabinda)</li>
          </ul>
        </div>
      </section>

      <footer class="footer">
        <div class="logo">
          <img src="citadelle-logo.png" alt="Citadelle">
        </div>
        <p>+242 06 403 33 28<br>BASE INDUSTRIELLE, POINTE-NOIRE, RÉP. DU CONGO</p>
      </footer>
    </main>
  </div>
</body>
</html>
