<?php
include_once '../register_login/verification.php';
include '../layouts/geral.php';

if (!isset($_POST['fase']) && !isset($_POST['nivel'])) {
    sleep(1);
    header('location: ../../index.php');
    exit;
} else {
    $fase = $_POST['fase'];
    $nivel = $_POST['nivel'];
}

try {
    $pergs = $pdo->prepare("SELECT respTrue FROM perg WHERE fase = $fase && nivel = $nivel");
    $pergs->execute();

    $notas = $pdo->prepare("SELECT * FROM notas WHERE user_id = $dados->id && fase = $fase");
    $notas->execute();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    sleep(1);
    unset($fase, $nivel, $pdo);
    header('location: ../../fases.php');
    exit;
}

$pontos = 0;

if (isset($pergs) && $pergs->rowCount() > 0) {
    $i = 0;
    $c = 0;

    while ($row = $pergs->fetch(PDO::FETCH_ASSOC)) {
        if ($row['respTrue'] == $_POST["resp$i"]) {
            $pontos++;
        }

        $i++;

        if ($i % 2 == 0) {
            $c++;
        }
    }

    // if($pergs->rowCount() == 7) {
    if ($pontos > $c) {
        echo "Parabens! Você ganhou {$pontos} pontos.<br>";
        $next = true;
    } else {
        echo "Que pena! Você ganhou apenas {$pontos} pontos.<br>";
        $next = false;
    }
   

    if (isset($notas) && $notas->rowCount() == 1) {
        $row = $notas->fetch(PDO::FETCH_ASSOC);
        // $next = true;

        if ($pontos > $row['nota']) {
            $sql = "UPDATE notas SET nota = $pontos";
            $stmt = $pdo->prepare($sql);
            try {
                $stmt->execute();
            } catch (\Throwable $th) {
                throw $th;
            }
            unset($sql, $stmt);
            echo "Notas atualizadas. Agora você foi melhor que da outra vez!<br>";
        }
    } else {

        if ($pontos >= 4) {
            // echo "Parabens! Você ganhou apenas {$pontos} pontos.";

            $sql = "INSERT INTO notas (user_id, fase, nivel, nota) VALUES ($dados->id, $fase, $nivel, $pontos)";
            $stmt = $pdo->prepare($sql);

            try {
                $stmt->execute();
            } catch (\Throwable $th) {
                throw $th;
            }
            unset($sql, $stmt);
        } else {
            echo "Tente novamente.";
        }
    }
} else {
    echo "Erro, nenhuma linha encontrada. Reporte esse erro ao desenvolvedor.";
    sleep(1);
    unset($fase, $nivel, $pergs, $pdo);
    header('location: ../../fases.php ');
    exit;
}

?>


<div class="d-flex m-5 flex-row-reverse">

    <?php
    if ($next == true) :
        $sql = "SELECT id, fase, nivel FROM perg WHERE fase = $fase && nivel = $nivel+1";
        $next_pergs = $pdo->prepare($sql);

        try {
            $next_pergs->execute();
        } catch (ErrorException $e) {
            echo "Erro, nenhuma linha encontrada. Reporte esse erro ao desenvolvedor.";
            sleep(1);
            unset($next_pergs, $nivel, $fase, $pergs, $notas, $pdo);
            header('location: ../../fases.php ');
            exit;
        }

        // Proximo nivel
        if (isset($next_pergs) && $next_pergs->rowCount() > 0) :
            $next_nivel = $nivel + 1;

            if ($dados->nivel < $next_nivel) {
                $_SESSION['nivel'] = $next_nivel;
                $sql = "UPDATE users SET nivel = $next_nivel WHERE id = $dados->id";
                $stmt = $pdo->prepare($sql);
                unset($sql);
                try {
                    $stmt->execute();
                } catch (\Throwable $th) {
                    throw $th;
                }
                unset($stmt);
            }
    ?>

            <form method="POST" action="./perg.php" class="fase position-relative m-5">
                <input type="number" value="<?php echo $fase; ?>" id="fase" class="d-none" name="fase" />
                <input type="number" value="<?php echo $next_nivel; ?>" id="nivel" class="d-none" name="nivel" />
                <input type="submit" id="enviarN" class="d-none" />
                <label for="enviarN" class="btnG btnRealist">
                    <i class='bi bi-x-diamond-fill'></i>
                    <h2> Proximo nivel </h2>
                </label>
            </form>

        <?php
        // Proxima fase
        else :
            $next_fase = $fase + 1;

            if ($dados->fase < $next_fase) {
                $_SESSION['fase'] = $next_fase;
                $_SESSION['nivel'] = 1;

                $sql = "UPDATE users SET fase = $next_fase, nivel = '1' WHERE id = $dados->id";
                $stmt = $pdo->prepare($sql);
                unset($sql);
                try {
                    $stmt->execute();
                } catch (\Throwable $th) {
                    throw $th;
                }
                unset($stmt);
            }

            // $row = $result->fetch(PDO::FETCH_ASSOC);
            // }
        ?>

            <form method="POST" action="./niveis.php" class="fase position-relative m-5">
                <input type="number" value="<?php echo $next_fase; ?>" id="fase" class="d-none" name="fase" />
                <input type="number" value="<?php echo '1'; ?>" id="nivel" class="d-none" name="nivel" />
                <input type="submit" id="enviarF" class="d-none" />
                <label for="enviarF" class="btnG btnRealist">
                    <i class='bi bi-x-diamond-fill'></i>
                    <h2> Próxima fase </h2>
                </label>
            </form>
    <?php
        endif;
    // header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));
    endif;

    $ago_page = ($_SERVER['HTTP_REFERER']);
    ?>

    <form method="POST" action="<?php echo $ago_page; ?>" class="fase position-relative m-5">
        <input type="number" value="<?php echo $nivel; ?>" id="nivel" class="d-none" name="nivel" />
        <input type="number" value="<?php echo $fase; ?>" id="fase" class="d-none" name="fase" />
        <input type="submit" id="enviarTN" class="d-none" />
        <label for="enviarTN" class="btnG btnRealist">
            <i class='bi bi-x-diamond-fill'></i>
            <h2> Tentar Novamente </h2>
        </label>
    </form>

</div>
<?php

unset($next_pergs, $nivel, $fase, $pergs, $noatas, $pdo);
exit;
?>