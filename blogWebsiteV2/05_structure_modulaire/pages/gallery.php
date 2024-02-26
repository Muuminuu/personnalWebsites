<?php
// $array_img = [
//     "https://cdn.pixabay.com/photo/2013/10/02/23/03/mountains-190055_960_720.jpg",
//     "https://cdn.pixabay.com/photo/2016/11/23/13/48/beach-1852945_960_720.jpg",
//     "https://cdn.pixabay.com/photo/2014/11/16/15/15/field-533541_960_720.jpg",
// ];
// le dossier contenant les images est indexé à "./assets/img"
$dir = "./assets/img/";
// tableau cré grâce à la fonction scandir capabl de scanner un dossier (à la recherche de fichiers)
$array_img = scandir($dir);
// unset( $array_img[0], $array_img[1] );
// var_dump($array_img);
// die();
?>

<h1>Gallery</h1>
<p>teteteetetetettessssssssssssssssssssst 
    lorem blablablaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>

<section id="gallery" class="row">
    <?php 
    // Pour chaque entrée dans le tableau $array_img
    // pour chaque fichier se trouvant dans le dossier $dir
    foreach($array_img as $src): ?>
    // on détermine le source complète avec le nom du fichier
    <?php $file = $dir.$src;
    // si cette source est bien un fichier on effectue le traitement, sinon rien.
    if(is_file($file)):;
    ?>    
    <article class="col-12 col-md-4 col-sm-6 mb-3">
        <div class="card">
            <img src="<?php echo $dir.$src; ?>" class="card-img-top" alt="image d'une campagne française">
                <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-dark">Read more</a>
            </div>
        </div>
    </article>
    <?php endif; ?>
<?php endforeach; ?>
</section>
