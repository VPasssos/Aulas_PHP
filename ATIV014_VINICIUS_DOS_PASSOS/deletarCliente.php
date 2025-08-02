<?php include 'menu.php'; ?>
<div class="container mt-5">

    <h2>Deletar Cliente</h2>
    <form action="processarDelecao.php" method="POST" class="row g-3">
        <div class="col-md-6">
            <label class="form-label">ID do Cliente:</label>
            <input type="number" name="id" class="form-control" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-danger">Deletar</button>
        </div>
    </form>
    
</div>
