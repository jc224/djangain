    <?php
    //       // Créer une image du graphique (exemple de graphique en barres)
    //       $data = [100, 40, 60, 80, 100];
    //       $libelle = ['100', '40', '60', '80', '100'];
    //       $bar_width = 40;
    //       $spacing = 20;
    //       $x = 10;
    //       $image_width = count($data) * ($bar_width + $spacing);
    //       $image_height = 300;
  
    //       $image = imagecreatetruecolor($image_width, $image_height);
    //       $background_color = imagecolorallocate($image, 255, 255, 255);
    // imagefill($image, 0, 0, $background_color);

    // $bar_color = imagecolorallocate($image,49, 132, 155);

    // foreach ($data as $value) {
    //     die(var_dump($value));
    //     imagefilledrectangle($image, $x, $image_height, $x + $bar_width, $image_height - $value, $bar_color);
    //     $x += $bar_width + $spacing;
    // }




    // Créez une image vide de taille 600x400 pixels
$image_width = 600;
$image_height = 400;
$image = imagecreatetruecolor($image_width, $image_height);

// Couleurs
$background_color = imagecolorallocate($image, 255, 255, 255);
$bar_color = imagecolorallocate($image, 0, 0, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);

// Remplissez l'arrière-plan en blanc (facultatif)
imagefill($image, 0, 0, $background_color);

// Données pour le graphique (à personnaliser)
$categories = ["Catégorie 1", "Catégorie 2", "Catégorie 3", "Catégorie 4", "Catégorie 5"];
$values = [12, 19, 3, 5, 2];

// Largeur et espacement des barres
$bar_width = 40;
$bar_spacing = 20;

// Coordonnées de départ pour les barres, les libellés et les valeurs
$x = 20;
$y = 300;

// Dessinez les barres, ajoutez les libellés et les valeurs
for ($i = 0; $i < count($categories); $i++) {
    // Dessinez la barre
    $bar_height = $values[$i] * 10; // Vous pouvez ajuster la hauteur en fonction de vos données
    imagefilledrectangle($image, $x, $y - $bar_height, $x + $bar_width, $y, $bar_color);

    // Ajoutez le libellé de la catégorie
    $label_x = $x + ($bar_width / 2) - (strlen($categories[$i]) * 3);
    $label_y = $y + 10;
    imagestring($image, 5, $label_x, $label_y, $categories[$i], $text_color);

    // Ajoutez la valeur au-dessus de la barre
    $value_x = $x + ($bar_width / 2) - (strlen($values[$i]) * 3);
    $value_y = $y - $bar_height - 15;
    imagestring($image, 5, $value_x, $value_y, $values[$i], $text_color);

    // Ajustez les coordonnées pour la prochaine barre, libellé et valeur
    $x += $bar_width + $bar_spacing;
}

// Ajoutez un titre au graphique
$title_x = ($image_width - 200) / 2;
$title_y = 10;
imagestring($image, 5, $title_x, $title_y, "Exemple de Graphique", $text_color);


    // Créer un fichier temporaire pour l'image
    $image_filename = tempnam(sys_get_temp_dir(), 'graph_');
    imagepng($image, $image_filename);
    imagedestroy($image);

    // Ajouter l'image au PDF avec MPDF
 

    // Nom du fichier PDF de sortie
    $pdf_filename = 'graphique.pdf';

    // Sortir le PDF vers un fichier


    // echo "Le graphique a été capturé et ajouté à $pdf_filename";




?>

<h1>Graphique dans MPDF</h1>
    <img src="<?=$image_filename ?>" alt="Graphique">';
