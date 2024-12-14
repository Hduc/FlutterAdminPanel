<?php
require_once "../controllers/notification.php";
$notification = new Notification();
 
if ($_SERVER['REQUEST_METHOD'] === 'POST' &&   isset($_POST['delete_notification'])) {
  $notification = new Notification(); 
  $notification->setParams($_POST);
  $notification->delete();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&   isset($_POST['delete_all_notification'])) {
  $notification = new Notification(); 
  $notification->setParams($_POST);
  $notification->delete_all();
}

?>
<!-- Content Header (Page header) -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Notification</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
      <li class="breadcrumb-item active">Notification</li>
    </ol>
  </div>

  <div>
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">List Notification</h6>


        <div>
        <a href="?page=notification_send" class="btn btn-success btn-icon-split btn-sm">
          <span class="icon text-white-50">
            <i class="fas fa-paper-plane"></i>
          </span>
          <span class="text">Send</span>
        </a>

 
          <a href="#" data-toggle="modal" data-target="#responsive-modal-all" class="btn btn-danger btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Delete old notification</span>
                  </a>
                  <!-- /.modal -->
                  <div class="modal fade" id="responsive-modal-all">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Delete</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure you want to delete all notification ? 
                          </p>
                        </div>
                        <form id="form-responsive-modal" method="post">
                          <input type="hidden" name="delete_all_notification" />
                          <div class="modal-footer justify-content-between"> 
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

      </div>
 
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Title</th> 
              <th>Content</th>
              <th>Url</th>
              <th style="width: 210px;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($notification->getAll() as $m) {
            ?>
              <tr>
                <td><?= $m['title'] ?></td>
                <td><?= $m['content'] ?></td>
                <td><a href="<?= $m['url'] ?>" target="_blank"><?= $m['url'] ?></a></td>


                <td> 
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
                          <p>Are you sure you want to delete this notification <b><?= $m['title'] ?></b> 
                          </p>
                        </div>
                        <form id="form-responsive-modal<?= $m['id'] ?>" method="post">
                          <input type="hidden" name="delete_notification" />
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
              <th>Icon</th>
              <th>Title</th>
              <th>Type</th>
              <th style="width: 210px;">Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>

</div>