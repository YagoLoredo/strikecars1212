<?php

namespace App\Controllers;

use App\Models\CidadeModel;
use App\Models\UsuarioModel;

class Login extends BaseController
{
    public $UsuarioModel;

	/**
	 * signIn
	 *
	 * @return void
	 */
    public function signIn() 
    {
		$post 		= $this->request->getPost();
		$login 		= $post['email'];
		$password 	= $post['senha'];
		
		if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
			return redirect()->back()->with('msgError', 'Por favor, insira um e-mail válido.')->withInput();
		}

		$UsuarioModel = new UsuarioModel();

		// buscar o usuário na base de dados

		$dadosUsuario = $UsuarioModel->getByEmail(trim($login));

		if (is_null($dadosUsuario)) {

			$CidadeModel = new CidadeModel();

			$aCidade = $CidadeModel->getCidade("MG", "Muriae");
			$created_at = date("Y-m-d H:i:s");

			// Verifica se existe usuários criados na base de dados

			if (count($UsuarioModel->findAll()) == 0) {

				$aPessoa = [
					"nome"		        => "Strike Cars",
					"ddd1"		        => "32",
					"celular1"		    => "987654321",
					"statusRegistro"	=> 1,
					"created_at"		=> $created_at,
					"updated_at"		=> $created_at
				]; 
		
				$aEndereco = [
					"tipoEndereco"      => 1,
					"logradouro"        => "Av. Altino Rodrigues Pereira",
					"numero"            => "10",
					"complemento"       => "",
					"bairro"            => "Jose Cirilo",
					"cep"               => "36880083",
					"cidade_id"         => $aCidade['id'],
					"created_at"		=> $created_at,
					"updated_at"		=> $created_at
				];
				
				$aUsuario = [
					"nome"				=> "Administrador",
					"nivel"				=> 1,                   // 1 = Administrador
					"statusRegistro"	=> 1,
					"email"				=> "administrador@strikecars.com.br",
					"senha"				=> password_hash("strikecars2024", PASSWORD_DEFAULT),
					"pessoa_id"		    => null,
					"created_at"		=> $created_at,
					"updated_at"		=> $created_at
				];
				
				

                if ($UsuarioModel->insertUsuario($aPessoa, $aEndereco, $aUsuario) > 0) {
					return redirect()->back()->with("msgSucess", "Super usuário criado com sucesso, favor efetar novamente o login")->withInput();
                } else {
					return redirect()->back()->with("msgError", "Falha na criação do Super usuário.")->withInput();
                }
			}
		}

		if (!is_null($dadosUsuario)) {

			// Verifica o status do usuário

			if ($dadosUsuario['statusRegistro'] == 1) {

				//	Verifica a senha do usuário

				if (password_verify(trim($password), $dadosUsuario['senha'])) {

					// Sessões de controle do usuário

					if (isset($post['manterConectado'])) {
						$tempoPdraoLogin = 864000;	// 10 Dias
					} else {
						$tempoPdraoLogin = 3600;	// 1 Hora
					}

					session()->setTempdata('isLoggedIn'		, true						, $tempoPdraoLogin);
					session()->setTempdata('userId'			, $dadosUsuario['id']		, $tempoPdraoLogin);
					session()->setTempdata('userNome'		, $dadosUsuario['nome']		, $tempoPdraoLogin);
					session()->setTempdata('userEmail'		, $dadosUsuario['email']	, $tempoPdraoLogin);
					session()->setTempdata('userNivel'		, $dadosUsuario['nivel']	, $tempoPdraoLogin);
					session()->setTempdata('userPessoa_id'	, $dadosUsuario['pessoa_id'], $tempoPdraoLogin);

					// 

					return redirect()->to('/home');

					//

					
				} else {
					return redirect()->back()->with("msgError", "Usuário ou Senha incorretos.")->withInput();
				}
			
			} else {
				return redirect()->back()->with("msgError", "Usuário BLOQUEADO/INATIVO, acesso indisponível.")->withInput();
			}

		} else {
			return redirect()->back()->with("msgError", "Usuário ou Senha incorretos.")->withInput();
		}
    }

    /**
	 * signOut
	 *
	 * @return void
	 */
	public function signOut()
	{
		session()->destroy();               // destroy as sessions
		return redirect()->to(base_url());
    }
	
	 /**
     * Processa a troca de senha
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function alterarSenhaProcess()
{
    // Recebe os dados do formulário
    $email = $this->request->getPost('email');
    $novaSenha = $this->request->getPost('novaSenha');
    $confirmaSenha = $this->request->getPost('confirmaSenha');

    // Valida se as senhas são iguais
    if ($novaSenha !== $confirmaSenha) {
        return redirect()->back()->with('msgError', 'As senhas não coincidem.')->withInput();
    }

    // Instancia o modelo de usuário
    $UsuarioModel = new UsuarioModel();

    // Busca o usuário pelo email
    $dadosUsuario = $UsuarioModel->getByEmail(trim($email));

    // Verifica se o usuário existe
    if ($dadosUsuario) {
        // Atualiza a senha
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
        
        if ($UsuarioModel->update($dadosUsuario['id'], ['senha' => $senhaHash])) {
            return redirect()->to('/login')->with('msgSucess', 'Senha alterada com sucesso!');
        } else {
            return redirect()->back()->with('msgError', 'Erro ao alterar a senha.')->withInput();
        }
    } else {
        return redirect()->back()->with('msgError', 'E-mail não encontrado.')->withInput();
    }
}


}
