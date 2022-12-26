<header>
    Filozofia
</header>
<nav class="navigation">
    <input type="checkbox" class="navigation__checkbox" id="navi-toggle">
    <label for="navi-toggle" class="navigation__button">
            <span class="navigation__icon">
                &nbsp;
            </span>
    </label>
    <ul class="navigation__list">
        <?php
        $menu = [
            '/' => 'Strona główna',
            '/quotes' => 'Cytaty',
            '/gallery' => 'Galeria memów',
            '/sources' => 'Źródła',
        ];
        foreach ($menu as $path => $name) {
            $active = $path === $_SERVER["REQUEST_URI"] ? 'active' : '';
            echo "<li class='navigation__list__element {$active}'><a class='navigation__link' href='{$path}'>{$name}</a></li>";
        }
        ?>
        <li class="navigation__dropdown navigation__list__element">
            <input id="dropdown_checkbox" type="checkbox" name="Filozofowie" class="navigation__dropdown__checkbox">
            <label for="dropdown_checkbox" class="navigation__dropdown__label">
                Filozofowie
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 36 36">
                    <path d="M10.5 15l7.5 7.5 7.5-7.5z"/>
                    <path d="M0 0h36v36h-36z" fill="none"/>
                </svg>
            </label>
            <ul class="navigation__dropdown__submenu">
                <?php
                $submenu = [
                    '/philosophers/presocratics' => 'Presokratycy',
                    '/philosophers/spa' => 'Sokrates, Platon, Arystoteles',
                    '/philosophers/remaining' => 'Pozostali',
                ];
                foreach ($submenu as $path => $name) {
                    $active = $path === $_SERVER["REQUEST_URI"] ? 'active' : '';
                    echo "<li class='navigation__list__element {$active}'><a class='navigation__link' href='{$path}'>{$name}</a></li>";
                }
                ?>
            </ul>
        </li>
        <?php
        if(isset($_SESSION['user_id'])) {
            echo "<li class='navigation__list__element right'><a class='navigation__link' href='/logout'>Wyloguj się</a></li>";
        } else {
            $active = '/login' === $_SERVER["REQUEST_URI"] ? 'active' : '';
            echo "<li class='navigation__list__element right {$active}'><a class='navigation__link' href='/login'>Zaloguj się</a></li>";
            $active = '/register' === $_SERVER["REQUEST_URI"] ? 'active' : '';
            echo "<li class='navigation__list__element {$active}'><a class='navigation__link' href='/register'>Zarejestruj się</a></li>";
        }
        ?>
    </ul>
</nav>
