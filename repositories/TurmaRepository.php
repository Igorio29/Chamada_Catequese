<?php
    require_once __DIR__ . "/../classes/Turma.php";

    class TurmaRepository {
        private $conn;

        public function __construct($conn)
        {
            $this->conn = $conn;
        }

        //MÉTODO RESPONSAVEL POR LISTAR TODAS AS TURMAS;
        public function listar(){

            $sql = "SELECT t.*, u.nome_catequista 
                    FROM tab_turma t 
                    INNER JOIN tab_usuario u ON u.id_catequista = t.catequista_id
                    ORDER BY t.etapa_turma ASC";
            $result = $this->conn->query($sql);

            $turmas = [];

            while($row = $result->fetch_assoc()){
                $turma = new Turma(
                    $row['etapa_turma'],
                    $row['ano_turma'],
                    $row['catequista_id'],
                    $row['nome_catequista'],
                    $row['id_turma'],
                );

                $turmas[] = $turma;
            }
            return $turmas;
        }

        public function listarPorCatequista($catequista_id){
            $sql = "SELECT t.*, u.nome_catequista 
                    FROM tab_turma t 
                    INNER JOIN tab_usuario u ON u.id_catequista = t.catequista_id
                    WHERE t.catequista_id = ?
                    ORDER BY t.etapa_turma ASC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $catequista_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $turmas = [];

            while($row = $result->fetch_assoc()){
                $turma = new Turma(
                    $row['etapa_turma'],
                    $row['ano_turma'],
                    $row['catequista_id'],
                    $row['nome_catequista'],
                    $row['id_turma']
                );

                $turmas[] = $turma;
            }

            return $turmas;
        }

        //MÉTODO QUE CRIA UMA TURMA;
        public function criar($etapa_turma, $ano_turma, $catequista_id){
            $sql = "INSERT INTO tab_turma (etapa_turma, ano_turma, catequista_id)
                    VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iii", $etapa_turma, $ano_turma, $catequista_id);
            return $stmt->execute();
        }

        //MÉTODO QUE ATUALIZA A TURMA NO BANCO
        public function atualizar($id_turma, $etapa_turma, $ano_turma, $catequista_id){
            $sql = "UPDATE tab_turma SET
                        etapa_turma = ?,
                        ano_turma = ?,
                        catequista_id = ?
                    WHERE id_turma = ?;
                    ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iiii", $etapa_turma, $ano_turma, $catequista_id, $id_turma);

            return $stmt->execute();
        }

        //MÉTODO QUE DELETA A TURMA DO BANCO
        public function deletar($id_turma){
            $sql = "DELETE FROM tab_turma 
                    WHERE id_turma = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id_turma);

            return $stmt->execute();
        }
    }
?>