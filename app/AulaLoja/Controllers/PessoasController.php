<?php

namespace AulaLoja\Controllers;

use AulaLoja\Controllers\Controller;

class PessoasController extends Controller {

    public function addPessoa($request, $response, $args) {
        // Pegar parâmetro apenas do formulário
        $dados = $request->getParsedBody();

        if (isset($dados['nome']) && isset($dados['email']) && isset($dados['fone'])) {
            $values = array_values($dados); //funcao array_values

            $insert = $this->dao->prepare("INSERT INTO pessoas (nome, cpf, endereco, rg, telefone) " . "VALUES (?,?,?,?,?)");
            if ($insert->execute($values)) {
                $urlRetorno = $this->router->pathFor('home');
                return $response->withRedirect($urlRetorno);
            }
        }
    }
    //
    // public function listaPessoas($request, $response, $args) {
    //     $pessoas = $this->dao->prepare("SELECT * FROM pessoas");
    //     $pessoas->execute();
    //     $lista = $pessoas->fetchAll();
    //
    //     //Status 200 significa que a ação deu certo
    //     $response = $response->withStatus(200);
    //     return $this->view->render($response, 'pessoas.twig', ['pessoas' => $lista]);
    // }

    public function addAtendimento($request, $response, $args) {
        // Pegar parâmetro apenas do formulário
        $dados = $request->getParsedBody();

        if (isset($dados['id_tipo']) && isset($dados['id_paciente']) && isset($dados['obs']) && isset($dados['data']) && isset($dados['retorno']) && isset($dados['valor'])) {
            $values = array_values($dados); //funcao array_values

            $insert = $this->dao->prepare("INSERT INTO atendimento (id_tipoAtendimento, id_pacientes, obs, data, retorno, valor ) " . "VALUES (?,?,?,?,?,?)");
            if ($insert->execute($values)) {
                $urlRetorno = $this->router->pathFor('home');
                return $response->withRedirect($urlRetorno);
            }
        }
    }

      public function listaAtendimentos($request, $response, $args){
          $atendimento = $this->dao->prepare("SELECT * FROM atendimento");
          $atendimento->execute();
          $lista = $atendimento->fetchAll();

          //Status 200 significa que a ação deu certo
          $response = $response->withStatus(200);
          return $this->view->render($response, 'home.twig', ['atendimentos' => $lista]);
      }

}

?>
