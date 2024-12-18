<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nome', 'nivel', 'statusRegistro', "email", 'senha', 'pessoa_id'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $validationRules = [
        'nome' => [
            "label" => 'Nome',
            'rules' => 'required|min_length[3]|max_length[50]'
        ],
        'nivel' => [
            'label' => 'Nível',
            'rules' => 'required|integer'
        ],
        'statusRegistro' => [
            'label' => 'Status',
            'rules' => 'required|integer'
        ],
        'email' => [
            "label" => 'E-mail',
            'rules' => 'required|valid_email'
        ],
    ];

    /**
     * getByEmail
     *
     * @param string $email 
     * @return array
     */
    public function getByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * insertUsuario
     *
     * @param array $aPessoa 
     * @param array $aEndereco 
     * @param array $aUsuario 
     * @return integer
     */
    public function getMenuUsuario()
{
    // Exemplo: Retorna todos os usuários com status ativo
    return $this->where('statusRegistro', 1)->findAll();
}
    public function insertUsuario($aPessoa, $aEndereco, $aUsuario) 
    {
        $db = \Config\Database::connect();

        $db->transBegin();      // Inicia controle de transação

        // insere a Empresa
        $tbPessoa = $db->table("pessoa");
        $tbPessoa->insert($aPessoa);

        $pessoa_id = $db->insertID();

        if ($pessoa_id > 0) {

            // Insere o usuário

            $aUsuario['pessoa_id']  = $pessoa_id;
            $aEndereco['pessoa_id'] = $pessoa_id;

            $tbEndereco = $db->table("pessoaendereco");
            $tbEndereco->insert($aEndereco);

            $tbUsuario = $db->table("usuario");
            $tbUsuario->insert($aUsuario);

            $usuario_id = $db->insertID();

            //

            if ($db->transStatus() === FALSE) {
                $db->transRollback();               // Defaz o que foi feito na base de dados
                return 0;
            } else {
                $db->transCommit();                 // Confirmar a gravação dos dados na base dados
                return $usuario_id;
            }

        } else {
            $db->transRollback();                   // Defaz o que foi feito na base de dados
            return 0;           
        }
    }
     /**
     * trocarSenha
     *
    * @param integer $id
    * @param string $novaSenha
    * @return bool
    */
   public function trocarSenha($id, $novaSenha)
   {
       // Verifica se a senha atende aos requisitos
       if (strlen($novaSenha) < 8) {
           return false; // Retorna falso se a senha não atende aos requisitos
       }

       // Criptografa a senha antes de salvar
       $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

       // Atualiza a senha no banco de dados
       return $this->update($id, ['senha' => $novaSenhaHash]);
   }
   
}