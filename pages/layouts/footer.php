    <footer class="start-0 m-0 mt-4 p-4">
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