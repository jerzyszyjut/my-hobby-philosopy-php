<a href="/gallery/add" class="gallery__add_image">
    <button>Dodaj zdjęcie do galerii</button>
</a>
<a href="/gallery/favourites" class="gallery__add_image">
    <button>Ulubione</button>
</a>

<form method="post" action="/gallery/add_to_favourite">
    <div class="gallery__images">
        <?php
        foreach ($images as $image) {
            echo '<div class="gallery__image">';
            echo "<a href='/gallery/view-image?id={$image->id}'>";
            echo "<img src='{$image->thumbnail_path}' alt='{$image->title}'>";
            echo "</a>";
            echo "<h2 class='gallery__image__title'>{$image->title}</h2>";
            echo "<h2 class='gallery__image__author'>Autor: {$image->author}</h2>";
            if($image->visibility === 'private') {
                echo "<h2 class='gallery__image__visibility'>Widoczność: prywatne</h2>";
            }
            $checked = in_array($image->id, $favourites) ? 'checked' : '';
            echo "<input type='checkbox' name='favourite[]' value='{$image->id}' {$checked}>";
            echo '</div>';
        }
        ?>
    </div>
    <button type="submit">Zapamiętaj wybrane</button>
</form>
<div class="gallery__navigation">
    <?php
    $CONFIG = include('../config.php');
    if ($page > 1) {
        echo "<a class='gallery__previous_page' href='/gallery?page=" . ($page - 1) . "'><button>Poprzednia strona</button></a>";
    }
    if ($next_page_exists) {
        echo "<a class='gallery__next_page' href='/gallery?page=" . ($page + 1) . "'><button>Następna strona</button></a>";
    }
    ?>
</div>
