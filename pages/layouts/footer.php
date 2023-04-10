    <footer class="position-absolute bottom-0 start-0">
        <div>
            Lorem ipsum dolor sit amet, consectetu
        </div>
    </footer>

    </main>

    <?php
    if (getcwd() == 'C:\xampp\htdocs\gameBiblico') {
        echo "<script src='././src/js/script.js'> </script>";
        $folderActual = "index";
    } else {
        // if (getcwd() == 'C:\xampp\htdocs\gameBiblico\pages\fases') {
        //     echo "<link rel='stylesheet' href='../../src/css/niveis.css'>";
        //     $folderActual = "insidePages";
        // }
        $folderActual = "insidePages";
        echo "<script src='../../src/js/script.js'> </script>";
    }
    ?>
    <script src=""></script>
    </body>

    </html>