<?php
/**
 * Package Voyage
 * Version 1.0.0
 */
/*
Plugin name: Voyage
Plugin uri: https://github.com/eddytuto
Version: 1.0.0
Description: Permet d'afficher les destinations qui répondent à certains critères
*/


function em_pays_enqueue()
{
// filemtime // retourne en milliseconde le temps de la dernière modification
// plugin_dir_path // retourne le chemin du répertoire du plugin
// __FILE__ // le fichier en train de s'exécuter
// wp_enqueue_style() // Intègre le link:css dans la page
// wp_enqueue_script() // intègre le script dans la page
// wp_enqueue_scripts // le hook

 $version_css = filemtime(plugin_dir_path(__FILE__) . "style.css");
    $version_js = filemtime(plugin_dir_path(__FILE__) . "js/ef-pays.js"); // Mettez à jour le nom du fichier ici
    wp_enqueue_style('em_plugin_pays_css', plugin_dir_url(__FILE__) . "style.css", array(), $version_css);
    wp_enqueue_script('em_plugin_pays_js', plugin_dir_url(__FILE__) . "js/ef-pays.js", array(), $version_js, true);
}
add_action('wp_enqueue_scripts', 'em_pays_enqueue');
/* Création de la liste des destinations en HTML */

function creation_pays() {
    $contenu = '
    
    <div class="les_boutons_categorie2">
        <button class="bouton__categorie" data-country="Canada">Canada</button>
        <button class="bouton__categorie" data-country="France">France</button>
        <button class="bouton__categorie" data-country="États-Unis">États-Unis</button>
        <button class="bouton__categorie" data-country="Chili">Chili</button>
        <button class="bouton__categorie" data-country="Belgique">Belgique</button>
        <button class="bouton__categorie" data-country="Maroc">Maroc</button>
        <button class="bouton__categorie" data-country="Mexique">Mexique</button>
        <button class="bouton__categorie" data-country="Japon">Japon</button>
        <button class="bouton__categorie" data-country="Italie">Italie</button>
        <button class="bouton__categorie" data-country="Islande">Islande</button>
        <button class="bouton__categorie" data-country="Chine">Chine</button>
        <button class="bouton__categorie" data-country="Grèce">Grèce</button>
        <button class="bouton__categorie" data-country="Suisse">Suisse</button>
    </div>
    <div class="contenu__restapi" id="destination-container">
        <!-- Les destinations seront affichées ici -->
    </div>';
    return $contenu;
}

add_shortcode('pays_selectionne', 'creation_pays');