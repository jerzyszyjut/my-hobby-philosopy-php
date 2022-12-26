<div class="hero" id="hero1"></div>
<div class="content">
    <section>
        <h1>Czym jest filozofia?</h1><br>
        <p>
            Filozofia jest czymś pośrednim między teologią a nauką.
            Podobnie jak teologia składa się bowiem ze
            spekulatywnych dociekań dotyczących rzeczy, co do których jak dotąd nie można było uzyskać ścisłej
            wiedzy, ale tak jak nauka odwołuje się raczej do ludzkiego rozumu niż do autorytetu: czy to
            autorytetu tradycji, czy objawienia. Cała ścisła wiedza jest — skłonny jestem twierdzić — domeną
            nauki; wszelkie dogmaty, które wykraczają poza ścisłą wiedzę, należą do teologii. Pomiędzy teologią
            a nauką rozciąga się jednak Ziemia Niczyja, narażona na ataki z obu stron; tą Ziemią Niczyją jest
            filozofia.
        </p><br>
        <p>
            Niemal wszystkie pytania, które najbardziej intrygują spekulatywne umysły, są wszak
            pytaniami, na które nauka nie potrafi udzielić odpowiedzi, a zdecydowane odpowiedzi teologów nie
            wydają się już tak przekonujące jak w minionych wiekach. Czy świat dzieli się na umysł i materię, a
            jeśli tak, to czym jest umysł i czym jest materia? Czy umysł zależy od materii, czy też ma jakieś
            niezależne własności? Czy we wszechświecie istnieje pewnego rodzaju jedność lub sens? Czy podlegają
            one ewolucyjnym procesom zmierzającym do jakiegoś celu? Czy rzeczywiście istnieją prawa przyrody,
            czy
            raczej jest tak, że wierzymy w nie tylko ze względu na wrodzone umiłowanie porządku? Czy człowiek
            jest tym, czym wydaje się astronomowi: maleńką drobiną zanieczyszczonego węgla i wody, bezsilnie
            pełzającą po małej, nieważnej planecie? Czy raczej tym, kim wydaje się Hamletowi? A może zarazem
            jednym i drugim? Czy istnieje szlachetny i nikczemny sposób życia, czy też jest raczej tak, że to,
            jak żyjemy, nie ma żadnego znaczenia? A jeżeli istnieje szlachetny sposób życia, to na czym polega i
            jak powinniśmy do niego dążyć? Czy dobro musi być czymś wiecznym, jeśli ma zasługiwać na to, byśmy
            je cenili, czy raczej warto o nie zabiegać, nawet jeśli wszechświat nieuchronnie zmierza ku
            zagładzie? Czy istnieje coś takiego jak mądrość, czy raczej to, co wydaje się mądrością, jest tylko
            najbardziej wyrafinowaną postacią szaleństwa?
        </p><br>
        <p>
            Odpowiedzi na takie pytania próżno szukać w
            laboratorium. Doktryny teologiczne deklarowały, że potrafią udzielić na nie aż nazbyt precyzyjnych
            odpowiedzi; ale właśnie owa precyzja każe współczesnym umysłom podchodzić do nich nieufnie. Badanie
            tego rodzaju pytań, nawet jeśli nie można udzielić na nie odpowiedzi, jest właściwym zadaniem
            filozofii.
        </p><br>
        <p>
            Po co jednak, mógłby ktoś zapytać, tracić czas na roztrząsanie takich nierozstrzygalnych
            zagadnień? Na to pytanie możemy udzielać odpowiedzi jako historycy bądź jako jednostki, które
            doświadczają lęku przed kosmiczną samotnością...
        </p><br><br>
        <p>Źródło: <em>Dzieje zachodniej filozofii, Wprowadzenie - Bertrand Russell</em></p>
    </section>
</div>
<div class="hero" id="hero2"></div>
<div class="content">
    <section>
        <h1>Ankieta</h1>
        <form class="poll" id="poll" action="./ankieta.php" method="POST">
            <fieldset>
                <legend>Informacje o tobie</legend>
                <label for="age" class="poll__question_label">Wiek:</label>
                <input type="number" id="age" name="age">
                <label class="poll__question_label">Płeć:</label>
                <span>
                            <input type="radio" name="gender" id="male" value="m">
                            <label for="male">Mężczyzna</label>
                        </span>
                <span>
                            <input type="radio" name="gender" id="female" value="f">
                            <label for="female">Kobieta</label>
                        </span>
                <label for="education" class="poll__question_label">Wykształcenie:</label>
                <select id="education" name="education">
                    <option value="">-</option>
                    <option value="0">Podstawowe</option>
                    <option value="1">Średnie</option>
                    <option value="2">W trakcie studiów</option>
                    <option value="3">Wyższe</option>
                </select>
                <label for="color" class="poll__question_label">Ulubiony kolor:</label>
                <input type="color" id="color" name="color">
            </fieldset>
            <fieldset>
                <legend>Ankieta właściwa</legend>
                <label class="poll__question_label">Z jakimi szkołami filozoficznymi starożytności miałeś
                    styczność?</label>
                <span>
                            <input type="checkbox" name="schools" id="sofisci" value="sofisci">
                            <label for="sofisci">Sofiści</label>
                        </span>
                <span>
                            <input type="checkbox" name="schools" id="platonicy" value="platonicy">
                            <label for="platonicy">Platonicy</label>
                        </span>
                <span>
                            <input type="checkbox" name="schools" id="arystotelicy" value="arystotelicy">
                            <label for="arystotelicy">Arystotelicy</label>
                        </span>
                <span>
                            <input type="checkbox" name="schools" id="stoicy" value="stoicy">
                            <label for="stoicy">Stoicy</label>
                        </span>
                <span>
                            <input type="checkbox" name="schools" id="epikurejczycy" value="epikurejczycy">
                            <label for="epikurejczycy">Epikurejczycy</label>
                        </span>
                <span>
                            <input type="checkbox" name="schools" id="cynicy" value="cynicy">
                            <label for="cynicy">Cynicy</label>
                        </span>
                <label class="poll__question_label" for="favourite-philosopher">Jaki jest twoim zdaniem
                    najważniejszy
                    filozof w historii?</label>
                <input type="text" id="favourite-philosopher" name="favourite-philosopher">
                <label class="poll__question_label" for="important-day">Jaki jest, twoim zdaniem, najważniejszy
                    dzień
                    w
                    historii ludzkości?</label>
                <input type="date" id="important-day" name="important-day" value="1971-01-24">
                <label class="poll__question_label" for="important-day-description">Co się wtedy
                    wydarzyło?</label>
                <input type="text" id="important-day-description" name="important-day-description">
            </fieldset>
            <input type="submit" value="Prześlij">
            <input type="reset" value="Wyczyść">
        </form>
    </section>
</div>

<div id="dialog-message" title="Błąd wartości formularza">
    <p></p>
</div>

