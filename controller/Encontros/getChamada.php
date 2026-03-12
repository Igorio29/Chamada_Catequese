<?php

include "../../conect.php";

$turma = $_GET["turma_id"];

$sql = "SELECT id_catequizando, nome_catequizando
        FROM tab_catequizando
        WHERE turma_id = $turma";

$result = $conn->query($sql);

echo '<div class="card mt-4 shadow-sm">';
echo '<div class="card-header bg-light">';
echo '<h5 class="mb-0"><i class="fa-solid fa-clipboard-check"></i> Lista de Presença</h5>';
echo '</div>';
echo '<div class="card-body">';
echo '<div class="row">';

while ($row = $result->fetch_assoc()) {

        echo '
        <div class="presenca-linha">
    
            <span class="nome">
                '.$row["nome_catequizando"].'
            </span>
    
            <div class="presenca-botoes">
    
                <input type="radio"
                       id="v_'.$row["id_catequizando"].'"
                       name="presenca['.$row["id_catequizando"].']"
                       value="1" required>
    
                <label for="v_'.$row["id_catequizando"].'" class="btn-presenca btn-v">
                    V
                </label>
    
    
                <input type="radio"
                       id="f_'.$row["id_catequizando"].'"
                       name="presenca['.$row["id_catequizando"].']"
                       value="0">
    
                <label for="f_'.$row["id_catequizando"].'" class="btn-presenca btn-f">
                    F
                </label>
    
            </div>
    
        </div>
        ';
    }


echo '</div>';
echo '</div>';
echo '</div>';
