<?= $this->extend('layouts/dashboard_bo')?>
<?= $this->section('content')?>
<?= $this->include('partials/page_title')?>

<?php
 if(empty($products)): ?>
    <div class="mb-3">
      <a href="<?=base_url('cart/add')?> " class="btn btn-outline-secondary"><i class="fa-solid fa-plus me-3"></i>New product</a>
    </div>
    <div class="text-center mt-5">
    <h4 class="opacity-50 mb-3">Não existem produtos no carrinho</h4>
    <span>Clique <a href="<?=base_url('cart/new')?>">aqui</a> para adicionar o primeiro produto ao carrinho</span>
  </div>
 <?php else: ?>
  <div class="container-fluid mb-5">
    <div class="row">
      <?php foreach($products as $product): ?>
        <?= view('partials/add_cart', ['product' => $product])?>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif;?>
<?= $this->endSection()?>
