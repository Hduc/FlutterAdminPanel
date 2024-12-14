<?php
require_once "../controllers/socials.php";
$socials = new Socials();
$socials->checkTable();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $socials = new Socials();
  $socials->setParams($_POST); 
}
?>
<!-- Content Header (Page header) -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">App Social</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
      <li class="breadcrumb-item active">Social</li>
    </ol>
  </div>

  <div>
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">List Social</h6>
 
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Icon</th>
              <th>Title</th>
              <th>App ID or Username</th>
              <th style="width: 150px;">Status</th>
              <th style="width: 110px;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($socials->getAll() as $s) {
            ?>
              <tr>
                <td><img src="../images/social/<?= $s['icon'] ?>?<?= time() ?>" style="width:30px" class="img-thumbnail"></td>
                <td><?= $s['title'] ?></td>
                <td><?= $s['id_app'] ?></td>
                <td>
                  <span class="badge <?= $s['status'] ? 'badge-success' : 'badge-secondary' ?>"><?= $s['status'] ? "Active" : "Inactive" ?></span>
                </td>
                <td>

                  <a href="?page=social_edit&id=<?= $s['id'] ?>" class="btn btn-info btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-pencil-alt"></i>
                    </span>
                    <span class="text">Edit</span>
                  </a>
  
                  <!-- /.modal --> 
      </div>
      <!-- End Modal -->
      </td>


      </tr>

    <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <th>Icon</th>
        <th>Title</th>
        <th>App ID or Username</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </tfoot>
    </table>
    </div>
  </div>
</div>

</div>