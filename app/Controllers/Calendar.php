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
        
        $product_model = new ProductModel();

        
        $products = $product_model->findAll();
       
        // Formata os produtos para o FullCalendar

        $formattedEvents = [];
        foreach ($products as $product) {
            $formattedEvents[] = [
                'title' => $product->name,
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
