<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cirso - Landing Page</title>
    <link rel="stylesheet" href="../css/indexStyle.css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Encabezado -->
    <header>
        <div class="logo">
            <img src="../img/logo.png" alt="Logo de CIRSO">
        </div>
        <div class="titulo"><h1> CIRSO </h1></div>
        <!-- <div class="search-bar">
            <input type="text" placeholder="Buscar por producto, categoría...">
        </div>-->
        <div class="icons">
            <span class="icon user-icon"><a href="../html/soporte.html"><img src="../img/support.png" title="Ayuda"></a></span>
            <span class="icon help-icon"><a href="login.php"><img src="../img/user.png" title="Perfil" ></a></span>
            <!--<img src="user-icon.png" alt="Usuario">
            <img src="question-icon.png" alt="Ayuda">-->
        </div>
    </header>
    <!--Carrusel-->
        <nav>
            <ul>
                <li><a href="#123">¿Quiénes somos?</a></li>
                <li><a href="#345">¿Cómo funciona?</a></li>
                <li><a href="#567">Artículos</a></li>
                <li><a href="#789">Envíos</a></li>
            </ul>
        </nav>
    
        <!-- Carrusel de imágenes -->
        <div class="carousel-container">
            <div class="carousel">
                <div class="slide">
                    <div class="question">Comparte</div>
                    <div class="image-background"></div>
                </div>
                <div class="slide">
                    <div class="question">Vive</div>
                    <div class="image-background"></div>
                </div>
                <div class="slide">
                    <div class="question">Acoge</div>
                    <div class="image-background"></div>
                </div>
                <div class="slide">
                    <div class="question">Ama</div>
                    <div class="image-background"></div>
                </div>
            </div>
            <!-- Botones de navegación -->
            <div class="nav-buttons">
                <button class="nav-button" onclick="prevSlide()">❮</button>
                <button class="nav-button" onclick="nextSlide()">❯</button>
            </div>
        </div>
        
    <!-- Sección de preguntas -->
    <div class="questions-box">
        <div class="quienessomos" id="123">
            <h3>¿Quiénes somos?</h3><br>
            <div class="content">
                <img src="../img/medium-shot-volunteers-with-donations (1).jpg" alt="Imagen sobre quienes somos" />
                <p>"Somos una organización llena de corazón, dedicada a cuidar y proteger a esos niños que,
                     por cosas de la vida, tienen que crecer con una familia de acogida. Sabemos lo complicado que
                      puede ser para todos: para los niños, que enfrentan un mundo nuevo, y para las familias, que abren sus puertas y
                       su corazón. Por eso estamos aquí, para acompañar y apoyar en este camino, ayudando a que juntos encuentren el amor,
                     la seguridad y la confianza que todos merecen."</p>
            </div>
        </div><br>
        
        <div class="comofunciona" id="345">
            <h3>¿Cómo funciona?</h3><br>
            <div class="content">
                <p>"Somos una organización que apuesta por la economía circular para mantener en uso todos esos elementos esenciales para el
                     desarrollo de los niños. Queremos asegurarnos de que nada se quede olvidado o sin aprovechar, porque sabemos que pueden 
                     marcar la diferencia para las familias de acogida. Así, esos recursos siempre están listos para ayudar a hacer el camino 
                     más fácil y ameno para todas esas familias.”</p>
                <img src="../img/family-home-working.jpg" alt="Imagen sobre cómo funciona" />
            </div>
        </div><br>
    
        <div class="quienessomos" id="567">
            <h3>Artículos</h3><br>
            <div class="content">
                <img src="../img/lesbian-couple-spending-time-with-their-daughter-home.jpg" alt="Imagen de recursos" />
                <p>Los artículos que se ofrezcan al resto de usuarios habrán formado parte del correcto 
                    desarrollo de un niño previamente, sin embargo, nos aseguraremos desde la organización
                     que dicho artículo siga contando con las plenas cualidades para facilitar el correcto
                      desarrollo en su próximo beneficiario. Es de suma importancia que lo que un día fue capaz 
                      de ayudar a uno, sea capaz de ayudar a muchos más. Es por ello que contamos con familias que no 
                      solo velan por las necesidades de sus hijos, sino por todos los niños que se encuentran en la misma situación.</p>
            </div>
        </div><br>
    
        <div class="quienessomos" id="789">
            <h3>Envíos</h3><br>
            <div class="content">
                <p>Contaremos con la enorme colaboración de SEUR express, que nos ayudaran a que estos envíos tan importantes no tarden más de 48 
                    horas en llegar al destinatario. 
                    Somos conscientes de lo imprevisible que es que un niño de acogida comience a formar parte de tu vida. 
                    Es por ello por lo que como organización queremos que aquello que a priori son nervios, imprevisión e incertidumbre, 
                    se sustituya por la emoción, las ganas y la inquietud de recibir a una vida que merece ser tratada de la mejor manera
                    posible.</p>
                <img src="../img/family-eating-together-night.jpg" alt="Imagen de envíos" />
            </div>
        </div><br>
    </div>
    
    <!--
        <div class="additional-images">
            <img src="../img/jersey.png" alt="Imagen 1">
            <img src="../img/jersey.png" alt="Imagen 2">
            <img src="../img/jersey.png" alt="Imagen 3">
            <img src="../img/jersey.png" alt="Imagen 4">
        </div>
    -->

    <!--Cookies-->
    <div class="info">
        <div class="info-logos">
            <a href="https://www.comunidad.madrid/"><img src="../img/cmadrid.png" alt="Logo Comunidad de Madrid" /></a>
            <a href="https://www.uax.com/"><img src="../img/uax_logo_nuevo_0.png" alt="Logo UAX" /></a>
            <a href="https://www.asnef.com/"><img src="../img/asnef.png" alt="Logo ASNEF" /></a>
            <a href="https://www.seur.com/es/index.html"><img src="../img/seur.png" alt="Logo SEUR" /></a>
        </div>
    </div>

    <div class="modal fade" id="cookieModal" tabindex="-1" aria-labelledby="cookieModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cookieModalLabel">Uso de Cookies</h5>
                </div>
                <div class="modal-body">
                    <p>Utilizamos cookies para mejorar la experiencia del usuario. Puedes elegir qué cookies permitir.</p>
                    <form id="cookiePreferencesForm">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="essentialCookies" disabled checked>
                            <label class="form-check-label" for="essentialCookies">Cookies esenciales (obligatorias)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="analyticsCookies">
                            <label class="form-check-label" for="analyticsCookies">Cookies de rendimiento</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="marketingCookies">
                            <label class="form-check-label" for="marketingCookies">Cookies de funcionalidad</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="marketingCookies">
                            <label class="form-check-label" for="marketingCookies">Cookies dirigidas</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="acceptAllCookies">Aceptar todas</button>
                    <button type="button" class="btn btn-primary" id="savePreferences">Guardar preferencias</button>
                </div>
            </div>
        </div>
    </div>
    
    

    <!-- Pie de página -->
    <footer>
        <a href="../html/politicasPrivacidad.html">Políticas privacidad</a>
        <a href="../html/politicasCookies.html">Políticas de cookies</a>
        <a href="../html/avisoLegal.html">Aviso Legal</a>
        <a href="../html/soporte.html">Centro de asistencia</a>
    </footer>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/cookies.js"></script>

    <script src="../js/carousel.js"></script>
</body>
</html>
