<?php namespace App\Controllers;

use App\Models\ClientesModel;
use App\Models\PessoasModel;

class Clientes extends BaseController
{
	public function index()
	{
		return view('clientes/clientes');
	}

	/*lista (array unidimensional)*/
	public function listaUni($cod_pessoa){
		$clientesModel = new ClientesModel();	

		/*puxando os dados da model*/
		$cliente = $clientesModel->listaUni($cod_pessoa);

		return $cliente;
	}

	/*lista (array multidimensional)*/
	public function listaMulti($dados){
		/*puxando os dados de filtro*/
		$filtro = $dados;

		/*instanciando a model*/
		$clientesModel = new ClientesModel();	

		/*puxando os dados da model*/
		$clientes = $clientesModel->listaMulti($filtro);

		return $clientes;
	}

	public function inserir(){
		/*instanciando a model*/
		$pessoasModel = new PessoasModel();
		$clientesModel = new ClientesModel();

		$form = $_POST;
		
		if(!empty($form)){
			/*verificando se o cpf não existe*/
			if($pessoasModel->validarCPF($form['cpf'])){

				$cod_pessoa = $pessoasModel->inserir($form);
		
				if($clientesModel->inserir($cod_pessoa)){
					
					$dados = $clientesModel->listaUni($cod_pessoa);
					//$html = ClientesMiddleware::adicionarCliente($dados);

					$resposta = array('status'=> 1, 
									'mensagem'=>'O cliente foi inserido com sucesso!',
									'dados'=>$dados);
				} else {
					$resposta = array('status'=> 3, 
											'mensagem'=>'Erro ao inserir o cliente');
				}
		
			} else {
				$resposta = array('status'=> 2, 
							'mensagem'=>'O CPF informado já está cadastrado');
			}

		} else {
			$resposta = array('status'=> 2, 
							'mensagem'=>'Os dados não foram enviados');
		}

		return json_encode($resposta);
	}

	public function atualizar(){
		/*instanciando a model*/
		$pessoasModel = new PessoasModel();
		$clientesModel = new ClientesModel();

		$form = $_POST;
		
		if(!empty($form)){
			/*verificando se o cpf não existe*/
			if($pessoasModel->validarCPF($form['cpf'], $form['cod_pessoa'])){

				if($pessoasModel->atualizar($form)){
					
					/*buscando dados atualizados para adicionar no front*/
					$dados = $clientesModel->listaUni($form['cod_pessoa']);

					$resposta = array('status'=> 1, 
									'mensagem'=>'O cliente foi atualizado com sucesso!',
									'dados'=>$dados);
				} else {
					$resposta = array('status'=> 3, 
											'mensagem'=>'Erro ao inserir o cliente');
				}
			
			} else {
				$resposta = array('status'=> 2, 
							'mensagem'=>'O CPF informado já está cadastrado');
			}

		} else {
			$resposta = array('status'=> 2, 
							'mensagem'=>'Os dados não foram enviados');
		}

		return json_encode($resposta);
	}

	public function deletar(){
		/*instanciando a model*/
		$pessoasModel = new PessoasModel();
		$clientesModel = new ClientesModel();

		$form = $_POST;

		/*verificando se o cpf não existe*/
		if($clientesModel->deletar($form['cod_pessoa'])){

			if($pessoasModel->deletar($form['cod_pessoa'])){

				$resposta = array('status'=> 1, 
								'mensagem'=>'O cliente foi removido com sucesso!');
			} else {
				$resposta = array('status'=> 3, 
										'mensagem'=>'Erro ao deletar');
			}
		
		} else {
			$resposta = array('status'=> 3, 
						'mensagem'=>'Erro ao deletar o cliente');
		}

		return json_encode($resposta);
	}

	public function listaUniJSON(){
		$cliente = $this->listaUni($_POST['cod_pessoa']);
		echo json_encode($cliente);
	}

	public function listaClientesJSON(){
		$clientes = $this->listaMulti($_GET);
		echo json_encode($clientes);
	}
}