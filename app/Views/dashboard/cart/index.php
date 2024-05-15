<?= $this->extend('layouts/dashboard_bo')?>
<?= $this->section('content')?>
<?= $this->include('partials/page_title')?>

<!-- Seção do calendário -->
<div id="calendar"></div>

<div class="mb-3">
  <a href="<?= base_url('cart/add') ?>" class="btn btn-outline-secondary"><i class="fa-solid fa-plus me-3"></i>Novo produto</a>
</div>

<?php if(empty($products)): ?>
  <div class="text-center mt-5">
    <h4 class="opacity-50 mb-3">Não existem produtos no carrinho</h4>
    <span>Clique <a href="<?= base_url('cart/add') ?>">aqui</a> para adicionar o primeiro produto ao carrinho</span>
  </div>
<?php else: ?>
  <div class="container-fluid mb-5">
    <div class="row">
      <?php foreach($products as $product): ?>
        <?= view('partials/cart', ['product' => $product])?>
      <?php endforeach; ?>
      <p class="text-end">Total: <?= $total_carrinho?></p>
    </div>
    <a href="<?= base_url('cart/limpar') ?>">Finalizar</a>
  </div>
<?php endif;?>
<?= $this->endSection() ?>
