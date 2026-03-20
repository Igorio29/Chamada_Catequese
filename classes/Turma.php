<?php
class Turma{
    private $id_turma;
    private $etapa_turma;
    private $ano_turma;
    private $catequista_id;
    private $nome_catequista;

    public function __construct($etapa_turma, $ano_turma, $catequista_id, $nome_catequista, $id_turma = NULL){
        $this->id_turma = $id_turma;
        $this->etapa_turma = $etapa_turma;
        $this->ano_turma = $ano_turma;
        $this->catequista_id = $catequista_id;
        $this->nome_catequista = $nome_catequista;
    }

    public function getId(){
        return $this->id_turma;
    }
    public function getEtapa(){
        return $this->etapa_turma;
    }
    public function getAno(){
        return $this->ano_turma;
    }
    public function getCatequistaId(){
        return $this->catequista_id;
    }
    public function getNomeCatequista(){
        return $this->nome_catequista;
    }
}
?>