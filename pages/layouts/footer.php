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
    
    </body>
</html>