<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\VendasModel;

class Calendar extends BaseController
{
    public function index()
    {

        $data =[
            'title' => 'Calendar',
            'page' => 'Calendar'
        ];
        
        $vendas = new VendasModel();

        
        $products = $vendas->findAll();
       
        $valorTotalDia = 0;
        
        foreach ($products as $venda) {
            $valorTotalDia += $venda->valor;
        }
     
        // Formata os produtos para o FullCalendar
        $formattedEvents = [];
        foreach ($products as $product) {
            $formattedEvents[] = [
                'title' => $valorTotalDia,
                'start' => $product->created_at, 
                'end' => $product->created_at// Supondo que a data de criação está armazenada neste campo
                // Você pode adicionar outros campos do produto, se necessário
            ];
        }
      

        // Envia os produtos formatados para a view
        $data['events'] = json_encode($formattedEvents);

        // Carrega a view com os produtos
        return view('partials/calendar', $data);
    }
}
