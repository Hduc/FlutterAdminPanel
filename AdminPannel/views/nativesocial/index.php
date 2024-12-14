<?php
require_once "../controllers/nativesocial.php";
$nativesocial = new NativeSocial();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nativesocial = new NativeSocial();
    $nativesocial->setParams($_POST);
    $nativesocial->delete();
}
?>
<!-- Content Header (Page header) -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List native social</h1>
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Native social</li>
        </ol>
    </div>

    <div>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">List native social</h6>
                <a href="?page=nativesocial_add" class="btn btn-success btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add</span>
                </a>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Start url with</th>
                            <th style="width: 150px;">Status</th>
                            <th style="width: 210px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($nativesocial->getAll() as $m) {
                        ?>
                            <tr>
                                <td><?= $m['title'] ?></td>
                                <td>
                                    <span class="badge <?= $m['status'] ? 'badge-success' : 'badge-secondary' ?>"><?= $m['status'] ? "Active" : "Inactive" ?></span>
                                </td>
                                <td>
                                    <a href="?page=nativesocial_edit&id=<?= $m['id'] ?>" class="btn btn-info btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-pencil-alt"></i>
                                        </span>
                                        <span class="text">Edit</span>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#responsive-modal<?= $m['id'] ?>" class="btn btn-danger btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Delete</span>
                                    </a>
                                    <!-- /.modal -->
                                    <div class="modal fade" id="responsive-modal<?= $m['id'] ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete this native social <b><?= $m['title'] ?></b>
                                                </div>
                                                <form id="form-responsive-modal<?= $m['id'] ?>" method="post">
                                                    <div class="modal-footer justify-content-between">
                                                        <input type="hidden" name="id" value="<?= $m['id'] ?>" />
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
            </div>
            <!-- End Modal -->
            </td>
            </tr>
        <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
        </table>
        </div>
    </div>
</div>