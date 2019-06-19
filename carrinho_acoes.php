<?php
session_start();// Avisando o PHP que essa página trabalha com sessões.

/** 
 * Verifico se a variavel d ações  existe, para então verificar qual ação o usuario ordenou.
 */
 
 if (isset($_Get['acao_carrinho']))  {

     switch($_Get['acao_carrinho'])  {

        case 'limpar': //na URL do navegador : carrinho_acoes.php?acao_carrinho=limpar
            $_SESSION['carrinho'] = array(); //Ao definir o carrinho como array navamente, limpamos elel.
        break;
        
        case 'add': // adiciona um produto ao carrinho.
        // Pegando as varíaveis da URL com os dados do produto (isso não é o ideal, apenas didático )
        $produto = $_GET['carr_produto'];
        $preco = $_GET['carr_preco'];
        $qnt = $_GET['carr_qnt'];
        $total = $preco * $qnt;

        $dados_produtos_a_ser_add = array("produto" => $produto, "preco" => $preco, "quantidade" => $qnt, "total" => $total);

        $_SESSION['carrinho'][] = $dados_produtos_a_ser_add; // Adicionando os dados estruturados do produto
    break;

    case 'remover';
      $item_carrinho = $_GET['item']; // pegando qual item o usuário quer remover

      if(isset($_SESSION['carrinho'][$item_carrinho])) { // Verificando se o item realmente existe
          unset($_SESSION['carrinho'][$item_carrinho]); // se existe, destrói o item
      }
    break;

    case 'atualiza-qnt';
       $item_carrinho = $_GET['item']; // pegando qual item o usuário quer atualizar a qnt.

       if(isset($_SESSION['carrinho'][$item_carrinho])) { // verificando se o item existe...
           $qnt = (int) $_GET['carr_qnt']; // pegando a quantidade que ele deseja.
           $total = $_SESSION['carrinho'][$item_carrinho]['preco'] * $qnt;  // atualizando o total...

           $_SESSION['carrinho'][$item_carrinho]['quantidade'] = $qnt; // definindo novamente a quantidade.
           $_SESSION['carrinho'][$item_carrinho]['toatal'] = $total; // definindo o novo total.
       }
    break;
} //fim do switch
} //fim do if do isset