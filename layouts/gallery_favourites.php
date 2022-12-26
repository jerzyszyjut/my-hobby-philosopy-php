<a href="/gallery/add" class="gallery__add_image">
    <button>Dodaj zdjęcie do galerii</button>
</a>
<a href="/gallery" class="gallery__add_image">
    <button>Wszystkie</button>
</a>
<form method="post" action="/gallery/remove_from_favourite">
    <div class="gallery__images">
        <?php
        foreach ($images as $image) {
            echo '<div class="gallery__image">';
            echo "<a href='/gallery/view-image?id={$image->id}'>";
            echo "<img src='{$image->thumbnail_path}' alt='{$image->title}'>";
            echo "</a>";
            echo "<h2 class='gallery__image__title'>{$image->title}</h2>";
            echo "<h2 class='gallery__image__author'>Autor: {$image->author}</h2>";
            echo "<input type='checkbox' name='favourite[]' value='{$image->id}'>";
            echo '</div>';
        }
        ?>
    </div>
    <button type="submit">Usuń zaznaczone z ulubionych</button>
</form>
x