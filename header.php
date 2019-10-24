
<header class="w3-container w3-light-grey w3-top w3-white w3-xlarge w3-padding-16">
    <span class="w3-left w3-padding site"><a href="index.php"><?php echo $NomSite; ?></a></span>
    <a href="javascript:void(0)" class="w3-right w3-button w3-black" onclick="w3_open()">☰</a>
</header>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-black w3-animate-right w3-top w3-text-light-grey w3-large" style="z-index:3;width:250px;font-weight:bold;display:none;right:0;" id="mySidebar">
    <a href="javascript:void()" onclick="w3_close()" class=" w3-button w3-right w3-padding-8">x</a> 
    <a href="index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-center w3-padding-16">Accueil</a> 
    <a href="information.php#informations" onclick="w3_close()" class="w3-bar-item w3-button w3-center w3-padding-16">Informations</a> 
    <a href="information.php#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-center w3-padding-16">Contact</a>
</nav>