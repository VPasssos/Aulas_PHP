<?php include 'menu.php'; ?>
<div class="container mt-5">
  <h2>Inserir Cliente</h2>
  <form action="processarinsercao.php" method="POST" class="row g-3">
      <div class="col-md-6">
          <label class="form-label">Nome:</label>
          <input type="text" name="nome" class="form-control" required>
      </div>
      <div class="col-md-6">
          <label class="form-label">Endereço:</label>
          <input type="text" name="endereco" class="form-control" required>
      </div>
      <div class="col-md-4">
          <label class="form-label">Telefone:</label>
          <input type="text" name="telefone" class="form-control" required>
      </div>
      <div class="col-md-8">
          <label class="form-label">Email:</label>
          <input type="email" name="email" class="form-control" required>
      </div>
      <div class="col-12">
          <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
  </form>
</div>
