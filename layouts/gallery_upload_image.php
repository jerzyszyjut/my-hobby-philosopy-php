<form class="gallery__form" action="/gallery/upload" method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Tytuł">
    <?php
    echo "<input type='text' name='author' placeholder='Autor' value='{$username}'>"
    ?>
    <input type="text" name="watermark" placeholder="Znak wodny">
    <input type="file" name="image" id="image"/>
    <?php
    if (strlen($username) > 0) {
        echo '<h2>Widoczność</h2>';
        echo '<label>';
        echo '<input type="radio" name="visibility" value="public" checked>';
        echo '<span>Publiczne</span>';
        echo '</label>';
        echo '<label>';
        echo '<input type="radio" name="visibility" value="private">';
        echo '<span>Prywatne</span>';
        echo '</label>';
    } else {
        echo '<input type="hidden" name="visibility" value="public">';
    }
    ?>
    <input type="submit" value="Upload"/>
</form>

