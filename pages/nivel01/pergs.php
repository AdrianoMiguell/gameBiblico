<?php

include_once '../register_login/verification.php';
include '../layouts/geral.php';

if (!isset($_GET['fase'])) {
    return header('location: ../../index.php');
} else {

    $fase = $_GET['fase'];

    if (isset($_GET['nivel'])) {
        $nivel = $_GET['nivel'];
    } else {
        $nivel = $dados->nivel;
    }
}

$pergs = $pdo->prepare("SELECT * FROM perg WHERE fase = $fase && nivel = $nivel");
$pergs->execute();

?>

<style>
    .pergs {
        display: flex;
        flex-direction: column;
        gap: .5em;
    }

    #divPerg {
        display: flex;
        flex-direction: column;
        text-align: center;
        gap: .5em;
    }

    .labelP {
        padding: .5em 2em;
        margin: .25em auto;
        width: 20em;
        word-wrap: break-word;
        text-shadow: 1px 1px 1px black;
        border-radius: 5px;
        cursor: pointer;
    }

    .block {
        display: none;
    }

    #divPreview {
        margin-top: 1em;
    }

    .btnP {
        margin-right: 1em;
        padding: 2.5px 10px;
        margin-top: 1em;
        border-radius: 100%;
    }

    .btnP {
        margin-right: 1em;
        padding: 2.5px 10px;
        margin-top: 1em;
        border-radius: 100%;
    }

    input[type="radio"]:checked~.labelP {
        background-color: rgba(var(--color-t), .9);
        box-shadow: 0 0 3px 3px rgb(var(--color-m)) inset,
            0 0 2px rgb(var(--color-t));
    }
</style>
<section class="niveis">
    <h1>
        Nivel 01
    </h1>
    <!-- d-none -->
    <form action="/" method="post" id="divPerg">
        <?php if (isset($pergs) && $pergs->rowCount() > 0) :
            $i = 0;
            $n = 0;
            while ($row = $pergs->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='pergs'> <h2 class='order'> Pergunta </h2>";
                echo "<legend class='perg'> {$row['numPerg']} - {$row['texto']} </legend>";
                echo "<div> <input type='radio' id='perg{$i}' name='resp{$n}' value='1' class='d-none'/> <label class='labelP btnSimple' onclick='np($n)' for='perg{$i}'>{$row['resp1']}</label> </div>";
                $i++;
                echo "<div> <input type='radio' id='perg{$i}' name='resp{$n}' value='2' class='d-none'/> <label class='labelP btnSimple' onclick='np($n)' for='perg{$i}'>{$row['resp2']}</label> </div>";
                $i++;
                echo "<div> <input type='radio' id='perg{$i}' name='resp{$n}' value='3' class='d-none'/> <label class='labelP btnSimple' onclick='np($n)' for='perg{$i}'>{$row['resp3']}</label> </div>";
                $i++;
                echo "<div> <input type='radio' id='perg{$i}' name='resp{$n}' value='4' class='d-none'/> <label class='labelP btnSimple' onclick='np($n)' for='perg{$i}'>{$row['resp4']}</label> </div>";
                $i++;
                echo "</div>";
                $n++;
            }
        ?>
    </form>
<?php else : ?>
    <div class="msg"> Em breve... {$row} </div>
<?php endif; ?>
</section>

<script>
    const divPerg = document.querySelector("#divPerg");
    const pergs = document.querySelectorAll(".pergs");
    const perg = document.querySelectorAll(".perg");
    const labelP = document.querySelectorAll(".labelP");
    const createBtnP = document.createElement("span");

    let atual = 0;

    console.log(labelP);
    for (let i = 0; i < pergs.length; i++) {
        createBtnP.setAttribute("id", "divPreview");

        if (i != 0) {
            pergs[i].classList.add("block");
            if (i != pergs.length - 1) {
                createBtnP.innerHTML += "<span class='btnP btnRealist block' onclick='cp(" + i + ")'>" + (i + 1) + "</span>";
            } else {
                const mel = createBtnP.innerHTML += "<span class='btnP btnRealist block' onclick='cp(" + i + ")'>" + (i + 1) + "</span> <button type='submit' class='btnP btnRealist px-1 rounded-1 block'> Enviar </button>";
                console.log(mel);
                // labelP[i].removeEventListener("click", np)
            }
        } else {
            createBtnP.innerHTML += "<span class='btnP btnRealist' onclick='cp(" + i + ")'>" + (i + 1) + "</span>";
            divPerg.appendChild(createBtnP);
        }

    }

    const btnP = document.querySelectorAll(".btnP");

    // function next-previous
    function np(n) {
        if (n < 6) {
            pergs[n].classList.add("block");
            pergs[n + 1].classList.remove("block");
            btnP[n + 1].classList.remove("block");
            if(n == 5) {
                btnP[n + 2].classList.remove("block");
            }
            atual = n + 1;
        }
    }

    // function create preivours
    function cp(n) {
        console.log("entt é", n, " - atual : ", atual);
        pergs[atual].classList.add("block");
        pergs[n].classList.remove("block");
        atual = n;

    }
</script>

<?php
include_once '../layouts/footer.php';
?>