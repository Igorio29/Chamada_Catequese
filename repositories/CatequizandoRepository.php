<?php
    require_once __dir__ . "/../classes/Catequizando.php";

    class CatequizandoRepository {
        private $conn;

        public function __construct($conn)
        {
            $this->conn = $conn;
        }

        //MÉTODO RESPONSAVEL POR LISTAR TODOS OS CATEQUIZANDOS
        public function ListarAll(){
            $sql = "SELECT ca.*, tu.etapa_turma, tu.ano_turma,tu.catequista_id, us.nome_catequista 
                    FROM tab_catequizando ca
                    INNER JOIN tab_turma tu ON tu.id_turma = ca.turma_id
                    INNER JOIN tab_usuario us ON us.id_catequista = tu.catequista_id";
            $result = $this->conn->query($sql);

            $catequizandos = [];

            while($row = $result->fetch_assoc()){
                $catequizando = new Catequizando(
                    $row['nome_catequizando'],
                    $row['data_nascimento'],
                    $row['telefone_responsavel'],
                    $row['turma_id'],
                    $row['etapa_turma'],
                    $row['ano_turma'],
                    $row['nome_catequista'],
                    $row['catequista_id'],
                    $row['id_catequizando']
                );
                $catequizandos[] = $catequizando;
            }
            return $catequizandos;
        }

        //MÉTODO RESPONSAVEL POR LISTAR OS CATEQUIZANDOS ESPECIFICO POR TURMA ATRAVÉS DO ID

        public function ListarForTurma($id_turma){
            $sql = "SELECT ca.*, tu.etapa_turma, tu.ano_turma, tu.catequista_id, us.nome_catequista
                    FROM tab_catequizando ca
                    INNER JOIN tab_turma tu ON tu.id_turma = ca.turma_id
                    INNER JOIN tab_usuario us ON us.id_catequista = tu.catequista_id
                    WHERE turma_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id_turma);
            $stmt->execute();
            $result = $stmt->get_result();

            $catequizandos = [];

            while($row = $result->fetch_assoc()){
                $catequizando = new Catequizando(
                    $row['nome_catequizando'],
                    $row['data_nascimento'],
                    $row['telefone_responsavel'],
                    $row['turma_id'],
                    $row['etapa_turma'],
                    $row['ano_turma'],
                    $row['nome_catequista'],
                    $row['catequista_id'],
                    $row['id_catequizando']
                );
                $catequizandos[] = $catequizando;
            }
            return $catequizandos;   
        }

        //MÉTODO RESPONSAVEL POR CRIAR OS CATEQUIZANDOS NO BANCO

        public function CriarCatequizando($nome_catequizando, $data_nascimento, $telefone_reponsavel, $turma_id){
            $sql = "INSERT INTO tab_catequizando (
                    nome_catequizando,
                    data_nascimento, 
                    telefone_responsavel, 
                    turma_id)
                    VALUES ( ? , ? , ? , ? )";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssi", $nome_catequizando, $data_nascimento, $telefone_reponsavel, $turma_id);
            return $stmt->execute();
        }

        public function AtualizarCatequizando($id_catequizando, $nome_catequizando, $data_nascimento, $telefone_reponsavel, $turma_id) {
            $sql = "UPDATE tab_catequizando SET
                    nome_catequizando = ?,
                    data_nascimento = ?,
                    telefone_responsavel = ?,
                    turma_id = ?
                    WHERE id_catequizando = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssii", $nome_catequizando, $data_nascimento, $telefone_reponsavel, $turma_id, $id_catequizando);
            return $stmt->execute();
        }

        public function DeletarCatequizando($id_catequizando){
            $sql = "DELETE FROM tab_catequizando 
                    WHERE id_catequizando = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id_catequizando);
            return $stmt->execute();
        }
    }
?>