<?php namespace App\Models;

use CodeIgniter\Model;

class PessoasModel extends Model{

	public function inserir($pessoa){
		
        $sql = "INSERT INTO pessoas (nome_completo, rg, cpf, data_nasc) 
                VALUES (".$this->db->escape($pessoa['nome']).", 
                        ".$this->db->escape($pessoa['rg']).",
                        ".$this->db->escape($pessoa['cpf']).",
                        STR_TO_DATE('".$pessoa['data_nasc']."', '%d/%m/%Y'))";
        $this->db->query($sql);
        
        /*se o registro for inserido*/
        if($this->db->affectedRows() >= 1){

            /*retorna o id inserido*/
            return $this->db->insertID();

        } else {
            return null;
        }
	}

	public function atualizar($pessoa){
        if($this->db->simpleQuery("UPDATE pessoas 
                                SET nome_completo = ".$this->db->escape($pessoa['nome']).", 
                                    rg = ".$this->db->escape($pessoa['rg']).",
                                    cpf = ".$this->db->escape($pessoa['cpf']).",
                                    data_nasc = STR_TO_DATE('".$pessoa['data_nasc']."', '%d/%m/%Y'),
                                    data_atualizacao = CURDATE()	
                                WHERE ID_PESSOA = ".$pessoa['cod_pessoa'])) 
        {
            /*registro atualizado*/
            return true;
        
        } else {
            return false;
        }
	}

	public function deletar($id_pessoa){

        if($this->db->simpleQuery("DELETE FROM pessoas
            WHERE id_pessoa = ".$id_pessoa))
        {
            /*registro deletado*/
            return true;
        } else {
            return false;
        }
    }
    
    public function validarCPF($cpf, $cod_pessoa=null){
        $query_cod_pessoa = !empty($cod_pessoa) ? 'AND id_pessoa != '.$cod_pessoa : '';
        
        $query = $this->db->query("SELECT count(*) as total
									FROM pessoas 
                                    WHERE cpf = '".$cpf."'
                                    ".$query_cod_pessoa);
        $row = $query->getRow();

        if($row->total > 0) {
            return false;   
        } else {
            return true;
        }
    } 
}