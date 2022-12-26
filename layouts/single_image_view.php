<?php
echo "<h1 class='gallery__image__title'>$image->title</h1>";
echo "<h1 class='gallery__image__author'>Autor: {$image->author}</h1>";
echo "<img src='{$image->watermark_path}' alt='{$image->title}' />";
if($image->visibility === 'private') {
    echo "<h2 class='gallery__image__visibility'>Widoczność: prywatne</h2>";
}
?>