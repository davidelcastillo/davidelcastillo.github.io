<footer class="footerFatherContainer">
        <div class="grupo">
            <section class="footerImageContainer box">
                <div class="Gibsonfooter">
                    <img src="../img/logoGibson.png" alt="Logo Gibson">
                </div>
            </section>
            <section class="footerInfoContainer box">
                <div class="containerLogos">
                    <a href="https://www.facebook.com/GibsonES/?brand_redir=98534165717" target="_blank">
                        <i  class="bi bi-facebook"></i>
                    </a>
                    <a href="https://twitter.com/Gibson" target="_blank">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/gibsonguitar" target="_blank">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
                <div class="footerEtiquetasA">
                    <a href="../html/ContactUs.html">Contact</a>
                    <a href="./Login.php">Sign in</a>
                    <a href="../html/AboutUs.html">About us</a>
                    <a href="../index.php">Menu</a>
                </div>
                <div class="footerMail">
                    <i class="bi bi-envelope"></i>
                </div>
            </section>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script> 
    <script>
        function showImage(src) {
            document.getElementById('main-image').src = src;
        }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchIcon = document.getElementById('searchIcon');
        const searchInput = document.getElementById('searchInput');

        searchIcon.addEventListener('click', function (event) {
            event.preventDefault(); // Prevenir el envío del formulario
            if (window.innerWidth <= 580) { // Solo para dispositivos móviles
                searchInput.classList.toggle('active');
                if (searchInput.classList.contains('active')) {
                    searchInput.focus(); // Poner el foco en el input cuando se muestra
                } else {
                    searchInput.value = ''; // Limpiar el input cuando se oculta
                }
            }
        });
    });
    </script>

</body>

</html>