<?php

namespace App\Controllers;

use App\Models\MarcaModel;
use App\Models\VeiculoImagemModel;
use App\Models\VeiculoModel;
use App\Models\UsuarioModel;
use App\Models\PedidoItemModel;
use App\Models\PedidoModel;
use App\Models\PessoaEnderecoModel;

class Home extends BaseController
{
	/**
	 * index
	 *
	 * @return void
	 */
	public function index()
	{
		$VeiculoModel = new VeiculoModel();
		
		if (is_null(session()->get('aMenuMarca'))) {

			$MarcaModel = new MarcaModel();
			$MarcaModel->getMenuMarca();
		}
		
		return view('home', $VeiculoModel->getListaHome());
	}

	/**
	 * Carrega a view Sobre nós
	 *
	 * @return void
	 */
	public function sobrenos()
	{
		return view("sobrenos");
	}
	

	/**
	 * Carrega a view Contato
	 *
	 * @return void
	 */
	public function contato()
	{
		return view("contato", $this->dados);
	}

	/**
	 * Carrega a view Contato
	 *
	 * @return void
	 */
	public function contatoEnviaEmail()
	{
		$email = \Config\Services::email();
		$email->initialize(CONFIG_EMAIL);

		$post = $this->request->getPost();

		$email->setFrom($post['email'], $post['nome']);				// Quem está enviando o e-mail
		$email->setTo("strikecars25@gmail.com");					// Define o (s) endereço (s) de e-mail do (s) destinatário (s).
		$email->setSubject($post['assunto']);						// Define o assunto do e-mail.
		$email->setMessage($post['mensagem']);						// Define o corpo da mensagem de e-mail:
		
		if ($email->send()) {
			return redirect()->to("/contato")->with("msgSucess", "E-mail enviado com sucesso, aguarde em breve entraremos em contato.");
		} else {
			return redirect()->back()->with("msgError", $email->printDebugger('header'))->withInput();
		}
	}

	/**
	 * Carrega a view Login
	 *
	 * @return void
	 */
	public function login()
	{
		return view("login");
	}

	/**
	 * Carrega a view Criar nova Conta
	 *
	 * @return void
	 */
	public function criarNovaConta()
	{
		$this->dados['data'] = [];
		return view("criarNovaConta", $this->dados);
	}

	public function admin()
	{
		return view("admin/home");
	}

	/**
	 * gravarNovaConta
	 *
	 * @return void
	 */
	public function gravarNovaConta()
	{
		$UsuarioModel = new UsuarioModel();

		$post = $this->request->getPost();
		
		// verificar se usuário já tem conta
		$temUsuario = $UsuarioModel->where("email", $post['email'])->first();

		if (is_null($temUsuario)) {

			if (trim($post['senha']) == trim($post['confirmaSenha'])) {

				$created_at = date("Y-m-d H:i:s");
	
				$aPessoa = [
					"nome"		        => $post['nome'],
					"ddd1"		        => $post['ddd1'],
					"celular1"		    => $post['celular1'],
					"statusRegistro"	=> 1,
					"created_at"		=> $created_at,
					"updated_at"		=> $created_at
				]; 
		
				$aEndereco = [
					"tipoEndereco"      => 1,
					"created_at"		=> $created_at,
					"updated_at"		=> $created_at
				];
				
				$aUsuario = [
					"nome"				=> $post['nome'],
					"nivel"				=> 11,                   // 1 = Administrador
					"statusRegistro"	=> 1,
					"email"				=> $post['email'],
					"senha"				=> password_hash(trim($post['senha']), PASSWORD_DEFAULT),
					"pessoa_id"		    => null,
					"created_at"		=> $created_at,
					"updated_at"		=> $created_at
				];
		
				if ($UsuarioModel->insertUsuario($aPessoa, $aEndereco, $aUsuario) > 0) {
					return redirect("criarNovaConta")->with("msgSucess", "Conta Criada com sucesso");
				} else {
	
					session()->set("msgError", $UsuarioModel->errors());
	
					return view('criarNovaConta', [
						'data'		=> $post,
						'errors' 	=> $UsuarioModel->errors()
					]);
				}
	
			} else {
				session()->setFlashdata("msgError", "Senhas não conferem.");
			} 
			
		} else {
			session()->setFlashdata("msgError", "Usuário já existe na plataforma.");
		}

		return view('criarNovaConta', [
				'data'		=> $post,
				'errors' 	=> []
			]);

	}


	/**
	 * 	Carrega a view carrinho de compras
	 *
	 * @return void
	 */
	public function carrinhoCompras()
	{
		return view('carrinho-compras');
	}
	
	public function meusenderecos()
	{
		return view ('PessoaEndereco');
	}

	/**
	 * Carrega a view carrinho pagamento
	 *
	 * @return void
	 */
	
	 public function homeMarca($marca_id)
	{
		$VeiculoModel = new VeiculoModel();
		
		if (is_null(session()->get('aMenuMarca'))) {
			$MarcaModel = new MarcaModel();
			$MarcaModel->getMenuMarca();
		}
		return view('home', $VeiculoModel->getListaHome(["id" => $marca_id]));
	}

	public function trocarSenha()
	{
		return view('trocarSenha');
	}
		public function gravarNovaSenha()
		{
			return view('gravarNovaSenha');
		}	

		/**
	 * addVeiculoCarrinho
	 *
	 * @return void
	 */
	public function addVeiculoCarrinho()
	{
		$VeiculoModel 		= new VeiculoModel();
		$VeiculoImagemModel = new VeiculoImagemModel();

		$post 			= $this->request->getPost();
		$aVeiculo		= $VeiculoModel->where("id", $post['veiculo_id'])->first();
		$aVeiculoImagem = $VeiculoImagemModel->where("veiculo_id", $post['veiculo_id'])->orderBy('created_at')->first();

		$aCarrinhoItens = session()->get("CarrinhoItens");

		if (is_null($aCarrinhoItens)) {
			$aCarrinhoItens = [];
		}

		$posicao = array_search($post['veiculo_id'], array_column($aCarrinhoItens, 'veiculo_id'));

		if ($posicao === false) {

			$aCarrinhoItens[] = [
				'veiculo_id' => $post['veiculo_id'],
				'modelo' => $aVeiculo['modelo'],
				"quantidade" => 1,
				"valorUnitario" => $aVeiculo['precoVenda'],
				"valorTotal" => $aVeiculo['precoVenda'],
				'imagem' => $aVeiculoImagem['nomeArquivo']
			];

		} else {

			$aCarrinhoItens[$posicao]['quantidade'] = $aCarrinhoItens[$posicao]['quantidade'] + 1;
			$aCarrinhoItens[$posicao]['valorTotal'] = $aCarrinhoItens[$posicao]['quantidade'] * $aCarrinhoItens[$posicao]['valorUnitario'];

		}

		session()->set("CarrinhoItens", $aCarrinhoItens);
	}
	/**
	 * atualizaVeiculoCarrinho
	 *
	 * @return void
	 */
	public function atualizaVeiculoCarrinho()
	{
		$post = $this->request->getPost();
		$aCarrinhoItens = session()->get("CarrinhoItens");

		$posicao = array_search((int)$post['veiculo_id'], array_column($aCarrinhoItens, 'veiculo_id'));

		if ($posicao !== false) {

			if ($post['quantidade'] == 0) {
				array_splice($aCarrinhoItens, $posicao, 1);
			} else {
				$aCarrinhoItens[$posicao]['quantidade'] = $post['quantidade'];
				$aCarrinhoItens[$posicao]['valorTotal'] = $aCarrinhoItens[$posicao]['quantidade'] * $aCarrinhoItens[$posicao]['valorUnitario'];
			}
		} 

		session()->set("CarrinhoItens", $aCarrinhoItens);
	}
	/**
	 * atualizaFrete
	 *
	 * @return void
	 */
	public function atualizaFrete() 
	{
		$post = $this->request->getPost();

		$aCarrinho = session()->get("Carrinho");

		$aCarrinho["tipoFrete"] = $post['tipoFrete'];

		session()->set("Carrinho", $aCarrinho);
	}
	/**
	 * atualizaFormaPagamento
	 *
	 * @return void
	 */
	public function atualizaCarrinho() 
	{
		$post = $this->request->getPost();

		$aCarrinho = session()->get("Carrinho");

		$aCarrinho["formaPagamento"] 	= $post['formaPagamento'];
		$aCarrinho['aceitaTermos']		= $post['aceitaTermos'];

		if ($post['pessoaendereco_id'] > 0) {
			$aCarrinho['pessoaendereco_id'] = $post['pessoaendereco_id'];
		}

		session()->set("Carrinho", $aCarrinho);
	}
	/**
	 * Carrega a view carrinho pagamento
	 *
	 * @return void
	 */
	public function carrinhoPagamento()
	{
		$PessoaEnderecoModel = new PessoaEnderecoModel();

		$this->dados['aPessoaEndereco'] = $PessoaEnderecoModel
												->select("pessoaendereco.*, cidade.nome as cidade, uf.sigla as uf")
												->join("cidade", "cidade.id = pessoaendereco.cidade_id")
												->join("uf", "uf.id = cidade.uf_id")
												->where('pessoaendereco.pessoa_id', session()->get('userPessoa_id') )
												->findAll();

		return view('carrinho-pagamento', $this->dados);
	}
	/**
	 * 	Carrega a view confirmação do carrinho de compras
	 *
	 * @return void
	 */
	/**
	 * 	Carrega a view confirmação do carrinho de compras
	 *
	 * @return void
	 */
	public function carrinhoConfirmacao()
	{
		$PedidoModel = new PedidoModel();
		$VeiculoModel = new VeiculoModel();
		$PedidoItemModel = new PedidoItemModel();
		$PessoaEnderecoModel = new PessoaEnderecoModel();

		$aCarrinho = session()->get("Carrinho");
		$aCarrinhoItens = session()->get("CarrinhoItens");

		// preparando o pedido

		$aCarrinho['pessoa_id'] = session()->get('userPessoa_id');
		$aCarrinho['statusRegistro'] = 1;

		$valorProdutos = 0;
		$valorFrete = 0;

		for ($xyx = 0; $xyx < count($aCarrinhoItens); $xyx++) {
			$valorProdutos += $aCarrinhoItens[$xyx]['valorTotal'];

			$veiculoId = $aCarrinhoItens[$xyx]['veiculo_id'];
			$VeiculoModel->update($veiculoId, ['statusRegistro' => 2]);

			unset($aCarrinhoItens[$xyx]['modelo']);
			unset($aCarrinhoItens[$xyx]['imagem']);
		}

		if ($aCarrinho['tipoFrete'] == 2) {
			$valorFrete = 15;
		}

		$aCarrinho['valorProdutos'] = $valorProdutos;
		$aCarrinho['valorFrete'] 	= $valorFrete;
		$aCarrinho['valorTotal'] 	= ($valorProdutos + $valorFrete);

		unset($aCarrinho['aceitaTermos']);
		unset($aCarrinho['endereco_id']);
		
		// Status

		$aStatus['statusRegistro'] 	= 1;
		$aStatus['usuario_id'] 		= session()->get('userId');

		$pedido_id = $PedidoModel->insertPedido($aCarrinho, $aCarrinhoItens, $aStatus);

		if ($pedido_id == 0) {
			redirect()->to("/carrinhoPagamento");
		} else {

			$this->dados['origem'] 		= "confirmacaoPedido";
			$this->dados['aPedido'] 	= $PedidoModel->where('id', $pedido_id)->first();
			$this->dados['aPedidoItem'] = $PedidoItemModel
												->select("pedidoitem.*, veiculo.modelo")
												->join("veiculo", "veiculo.id = pedidoitem.veiculo_id")
												->where('pedido_id', $pedido_id)
												->findAll();
			
			$this->dados['aEnderecoCob'] = $PessoaEnderecoModel
													->select("pessoaendereco.*, cidade.nome as cidade, uf.sigla as uf")
													->join("cidade", "cidade.id = pessoaendereco.cidade_id")
													->join("uf", "uf.id = cidade.uf_id")
													->where(['tipoEndereco' => 1,'pessoaendereco.id'=> $this->dados['aPedido']['pessoaendereco_id']])
													->first();

			$this->dados['aEnderecoEnt'] = $PessoaEnderecoModel
													->select("pessoaendereco.*, cidade.nome as cidade, uf.sigla as uf")
													->join("cidade", "cidade.id = pessoaendereco.cidade_id")
													->join("uf", "uf.id = cidade.uf_id")
													->where('pessoaendereco.id', $this->dados['aPedido']['pessoaendereco_id'])
													->first();

			session()->set("Carrinho", null);
			session()->set("CarrinhoItens", null);

			return view('carrinho-confirmacao', $this->dados);
		}
}





	


	/**
	 * veiculoDetalhe
	 *
	 * @param mixed $id 
	 * @return void
	 */
	public function veiculoDetalhe($id)
	{
		$VeiculoModel = new VeiculoModel();
		$VeiculoImagemModel = new VeiculoImagemModel();

		$veiculo = $VeiculoModel->find($id);
		$veiculo['imagem'] = $VeiculoImagemModel->where("veiculo_id", $id)->findAll();
		
		return view('veiculo-detalhe', $veiculo);
	}
}
