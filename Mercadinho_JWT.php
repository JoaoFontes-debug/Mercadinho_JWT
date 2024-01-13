<?php
class Produto
{
    private $nome;
    private $preco;
    private $quantidade;

    // Método para definir os atributos do produto
    public function setProduto($data)
    {
        // Verifica se 'nome' está presente nos dados e define o atributo 
        if (isset($data['nome'])) {
            $this->nome = $data['nome'];
        }

        // Verifica se 'preco' está presente nos dados e define o atributo 
        if (isset($data['preco'])) {
            $this->preco = $data['preco'];
        }

        // Verifica se 'quantidade' está presente nos dados e define o atributo 
        if (isset($data['quantidade'])) {
            $this->quantidade = $data['quantidade'];
        }
    }

    // Método para exibir informações do produto
    public function getProduto()
    {
        // Verifica se o produto foi cadastrado
        if ($this->nome === null) {
            print('Nenhum produto cadastrado!<br>');
            return null;
        }

        // Exibe informações do produto
        print("PRODUTO CADASTRADO <br>");
        echo "Nome: " . $this->nome . "<br>";
        echo "Preço: " . $this->preco . "<br>";
        echo "Quantidade: " . $this->quantidade . "<br>";

        return $this;
    }

    // Método para obter a quantidade disponível em estoque
    public function getQuantidadeDisponivel()
    {
        return $this->quantidade;
    }

    // Método para definir a quantidade disponível em estoque
    public function setQuantidadeDisponivel($novo_valor)
    {
        $this->quantidade = $novo_valor;
        return;
    }
}

class Venda extends Produto
{
    private $quantidadeVenda;
    private $desconto;

    // Método para realizar uma venda
    public function setVenda($data)
    {
        // Verifica se o produto está cadastrado
        if ($this->getProduto() === null) {
            echo 'Não foi possível concluir a venda.<br>';
            return;
        }

        // Valida a quantidade disponível em estoque
        if ($this->getQuantidadeDisponivel() < $data['quantidadeVenda']) {
            echo 'Não há produtos o suficiente no estoque.<br>';
            return;
        }

        // Registra a quantidade de venda $this->quantidadeVenda = $data['quantidadeVenda'];     
        $quantidade_disponivel = $this->getQuantidadeDisponivel();

        // Atualiza a quantidade disponível em estoque
        $nova_quantidade = $quantidade_disponivel - $data['quantidadeVenda'];
        $this->setQuantidadeDisponivel($nova_quantidade);

        // Aplica o desconto
        $desconto = isset($data['desconto']) ? $data['desconto'] : 0;
        $this->desconto = $desconto;

        echo '<br>Venda concluída com sucesso!<br><br>';
    }

    // Método para exibir informações da última venda realizada
    public function getVenda()
    {
        echo 'ÚLTIMA VENDA REGISTRADA<br>';

        echo "Quantidade da venda: " . $this->quantidadeVenda . "<br>";
        echo "Desconto aplicado: " . $this->desconto . "<br>";
        echo "Estoque atual: " . $this->getQuantidadeDisponivel() . "<br>";
    }
}

// EXEMPLO:

// Criar uma nova venda
$minha_venda = new Venda();

// Criar produto a ser cadastrado
$produto_camisa = array('nome' => 'Camisa', 'preco' => 100, 'quantidade' => 30);

// Cadastrar produto
$minha_venda->setProduto($produto_camisa);

// Criar uma nova venda
$dados_venda = array('quantidadeVenda' => 25, 'desconto' => 8.0);

// Cadastrar uma nova venda
$minha_venda->setVenda($dados_venda);

// Obter informações da última venda realizada
$minha_venda->getVenda();
