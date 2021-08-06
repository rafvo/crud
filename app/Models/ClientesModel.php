<?php namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model{

    public function listaUni($cod_pessoa){
        $query = $this->db->query("SELECT pes.id_pessoa
                                        ,pes.nome_completo
                                        ,pes.rg
                                        ,pes.cpf
                                        ,DATE_FORMAT(pes.data_nasc, '%d/%m/%Y') AS data_nasc
                                        ,DATE_FORMAT(pes.data_nasc, '%Y/%m/%d') AS data_nasc_field
                                        ,pes.status
                                        ,DATE_FORMAT(pes.data_registro,'%d/%m/%Y') AS data_registro
                                        ,DATE_FORMAT(pes.data_atualizacao,'%d/%m/%Y') AS data_atualizacao
                                FROM pessoas pes
                                    ,clientes cli
                                WHERE pes.id_pessoa = cli.cod_pessoa
                                AND cli.cod_pessoa = ".$cod_pessoa);

        $row = $query->getRow();
        return $row;
	}
    
    public function listaMulti($filtro=array()){     
        $query = $this->db->query("SELECT pes.id_pessoa
                                ,pes.nome_completo
                                ,pes.rg
                                ,pes.cpf
                                ,DATE_FORMAT(pes.data_nasc,'%d/%m/%Y') AS data_nasc
                                ,pes.status
                                ,DATE_FORMAT(pes.data_registro,'%d/%m/%Y') AS data_registro
                                ,DATE_FORMAT(pes.data_atualizacao,'%d/%m/%Y') AS data_atualizacao
                        FROM pessoas pes
                            ,clientes cli
                        WHERE pes.id_pessoa = cli.cod_pessoa");

		$results = $query->getResultArray();

		return $results;
	}

	public function inserir($cod_pessoa){
		
        $sql = "INSERT INTO clientes (cod_pessoa) 
                VALUES (".$cod_pessoa.")";
        $this->db->query($sql);
        
        if($this->db->affectedRows() >= 1)
        {
            /*registro inserido*/
            return true;

        } else {
            return false;
        }
	}

	public function deletar($cod_pessoa){

        if($this->db->simpleQuery("DELETE FROM clientes
                                WHERE cod_pessoa = ".$cod_pessoa))
        {
            
            /*registro deletado*/
            return true;
        } else {
            return false;
        }
	}
}