    <footer class="position-absolute bottom-0 start-0 m-4">
        <div>
            Lorem ipsum dolor sit amet, consectetu
        </div>
    </footer>

    </main>

    <?php
    if (getcwd() == 'C:\xampp\htdocs\gameBiblico') {
        echo "<script src='././src/js/script.js'> </script>";
        echo "<script src='././src/js/events.js'> </script>";
        $folderActual = "index";
    } else {
        $folderActual = "insidePages";
        echo "<script src='../../src/js/script.js'> </script>";
        echo "<script src='../../src/js/events.js'> </script>";
    }
    ?>
    <script src=""></script>
    </body>

    </html>