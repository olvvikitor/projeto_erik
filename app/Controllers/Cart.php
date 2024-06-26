<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Migrations\VendaTable;
use App\Models\Cart as ModelsCart;
use App\Models\CartModel;
use App\Models\ProductModel;
use App\Models\VendasModel;

class Cart extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Carrinho',
            'page' => 'Carrinho'
        ];
        
        // Obtém o carrinho da sessão
        $cart = session()->get('cart');
        
        // Define os produtos na variável $data para serem passados para a view
        $data['products'] = $cart;
        
        // Soma os subtotais dos itens no carrinho
        $total_carrinho = 0;
        if(!empty($cart)){
        foreach ($cart as $item) {
            $total_carrinho += $item['subtotal'];
        }
    }
        session()->set('total_carrinho', $total_carrinho);
        // Define o total do carrinho na variável $data
        $data['total_carrinho'] = $total_carrinho;
        // Retorna a view com os dados
        return view('dashboard/cart/index', $data);
    }
    public function add()
    {

        $data = [
            'title' => 'Produtos disponiveis',
            'page' => 'Produtos disponiveis',
        ];
        $data['validation_errors'] = session()->getFlashdata('validation_errors');
        //get product stock
        $product_model = new ProductModel();
        $data['products'] = $product_model->findAll();

        return view('dashboard/cart/add_to_cart', $data);
    }
    public function add_submit()
    {
        $session = session();
    
      
        $product_ids = $this->request->getPost('product_id');
        $quantities = $this->request->getPost('quantity');
        $names = $this->request->getPost('name');
        $price = $this->request->getPost('price');
        // Verifica se já existe um carrinho na sessão
        $cart = $session->get('cart') ?? [];
    
        $item = [
            'product_id' => $product_ids,
            'quantity' => intval($quantities),
            'name' => $names,
            'price' => floatval($price)
        ];
    
   
        $item['subtotal'] = $item['quantity'] * $item['price'];
    
        $cart[] = $item;
    
        $session->set('cart', $cart);
    
        return redirect()->to(base_url('cart'));
    }
public function limpar()
{
    // Recupera os dados da sessão cart
    $cart = session()->get('cart');
    $total = session()->get('total_carrinho');
    $user_id = session()->user['id'];


    if ($cart) {
        // Carrega o model de Vendas
        $vendasModel = new VendasModel();

        // Itera sobre os itens do carrinho e insere na tabela vendas
        foreach ($cart as $item) {
            // Verifica se os dados do item do carrinho são válidos
            if (!empty($item['product_id']) && $item['quantity'] > 0 && $item['subtotal'] > 0) {
                $vendaData = [
                    'user_id'    => $user_id,
                    'quantidade' => $item['quantity'],
                    'valor'      => $total,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
    
                ];
               
                $vendasModel->insert($vendaData);
            }
        }
    }

    // Remove o carrinho da sessão
    session()->remove('cart');
    session()->remove('total_carrinho');
   
    return redirect()->to(base_url('cart'));
}

}
