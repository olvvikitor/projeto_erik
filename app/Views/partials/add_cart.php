User
<div class="col-xxl-12 col-12">
  <div class="content-box shadow overflow-hidden">
    <div class="row">
      <div class="col-md-4">
        <?php
        $image = base_url('assets/images/products/' . $product->image);
        $tmp = ROOTPATH . 'public/assets/images/products/' . $product->image;
        $validate = session()->getFlashdata('validate');

        if (!file_exists($tmp)) {
          $image = base_url('assets/images/products/no-image.png');
        }
        ?>
        <div style="width: 100px; height: 100px;">
          <?php if ($product->promotion > 0) : ?>
            <span class="mb-2 badge bg-success">(Com promoção de <?= $product->promotion ?>%) </span>
          <?php endif; ?>
          <img src="<?= $image ?>" alt="<?= $product->image ?>" class="img-fluid mx-5">
        </div>
      </div>
      <div class="col-md-8">
        <div class="row">
          <div class="col-6">
            <h3 class="mt-0"><strong><?= $product->name ?></strong></h3>
            <p class="m-0"><strong> <?= $product->marca ?> </strong></p>
            <p class="m-0"><strong> <?= $product->price ?> </strong></p>
            

            <?php if ($product->stock < $product->stock_min) : ?>
              <span class=" mb-1 badge bg-danger"><?= $product->stock  == 1 ? $product->stock . ' unidade' : $product->stock . ' unidades' ?></span>
              <span class=" mb-1 badge bg-warning">Estoque limite</span>
            <?php else : ?>
              <span class="mb-1 badge bg-success"><?= $product->stock  == 1 ? $product->stock . ' unidade' : $product->stock . ' unidades' ?></span>
            <?php endif; ?>
          </div>

          <div class="col-6 d-flex justify-content-end align-items-start">
            <?= form_open('cart/add_submit', ['id' => 'add_form', 'novalidate' => false]) ?>
              <div class="form-group">
                <label for="quantity_<?= $product->id ?>" class="form-label">Quantidade:</label>
                <input type="number" id="quantity_<?= $product->id ?>" name="quantity" class="form-control" value="<?= old('quantity') ?>" min="0">
                <input type="hidden" name="product_id" value="<?= $product->id ?>">
                <input type="hidden" name="name" value="<?= $product->name?>">
                <input type="hidden" name="price" value="<?=calculate_promotion( $product->price, $product->promotion)?>">
              </div>
              <button onclick="enviarCarrinhoParaServidor()" class="btn btn-sm btn-outline-success mx-1" style="font-size: small"><i class="fas fa-edit edit-icon"></i>Adicionar ao carrinho</button>
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
  // Função para enviar os dados do carrinho para o servidor
  function enviarCarrinhoParaServidor() {
    var produtos = JSON.parse(localStorage.getItem('produtos')) || [];
    
    // Envia os dados do carrinho para o servidor usando AJAX
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('cart/add_submit'); ?>",
      data: { produtos: produtos },
      success: function(response) {
        // Trate a resposta do servidor, se necessário
        console.log("Dados do carrinho enviados com sucesso para o servidor.");
      },
      error: function(xhr, status, error) {
        // Trate erros de requisição, se necessário
        console.error("Erro ao enviar dados do carrinho para o servidor: " + error);
      }
    });
  }
</script>