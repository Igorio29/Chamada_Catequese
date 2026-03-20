<?php
class Catequizando
{
    private $id_catequizando;
    private $nome_catequizando;
    private $data_nascimento;
    private $telefone_responsavel;
    private $turma_id;
    private $etapa_turma;
    private $ano_turma;
    private $nome_catequista;
    private $catequista_id;

    public function __construct($nome_catequizando, $data_nascimento, $telefone_responsavel, $turma_id, $etapa_turma, $ano_turma, $nome_catequista, $catequista_id, $id_catequizando = NULL)
    {
        $this->id_catequizando = $id_catequizando;
        $this->nome_catequizando = $nome_catequizando;
        $this->data_nascimento = $data_nascimento;
        $this->telefone_responsavel = $telefone_responsavel;
        $this->turma_id = $turma_id;
        $this->etapa_turma = $etapa_turma;
        $this->ano_turma = $ano_turma;
        $this->nome_catequista = $nome_catequista;
        $this->catequista_id = $catequista_id;
    }

    public function getId()
    {
        return $this->id_catequizando;
    }
    public function getNomeCatequizando()
    {
        return $this->nome_catequizando;
    }
    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }
    public function getTelefoneResponsavel()
    {
        return $this->telefone_responsavel;
    }
    public function getTurmaId()
    {
        return $this->turma_id;
    }
    public function getEtapaTurma()
    {
        return $this->etapa_turma;
    }
    public function getAnoTurma()
    {
        return $this->ano_turma;
    }
    public function getNomeCatequista()
    {
        return $this->nome_catequista;
    }
    public function getCatequistaId()
    {
        return $this->catequista_id;
    }
}
?>