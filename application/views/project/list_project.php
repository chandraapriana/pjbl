
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

          <div class="col-lg-10">
            <table class="table">
              <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Project</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php for ($i=0; $i < count($project) ; $i++) :?>
                  <tr>
                    <th scope="row"><?= $i+1 ?></th>
                    <td>
                        <a href="<?=base_url('project/lihat_project/').$project[$i]['id']?>" ><?= $project[$i]['nama_project'] ?></a>
                      </td>
                    <td>
                      <a href="<?= base_url('project/kelompok/'.$project[$i]['id'])?>" class="btn btn-primary">Lihat Kelompok</a>
                      <a href="<?= base_url('project/edit_project/'.$project[$i]['id'])?>" class="btn btn-warning">Edit</a>
                      <a href="<?= base_url('project/deleteProject/'.$project[$i]['id'])?>" class="btn btn-danger" data-toggle="modal" data-target="#logoutModal">Delete</a>
                    </td>
                  </tr>

                  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Are You Sure to Delete This Project ?</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                          <a class="btn btn-primary" href="<?= base_url('project/deleteProject/'.$project[$i]['id'])?>">Delete</a>
                        </div>
                      </div>
                    </div>
                  </div>

                <?php endfor; ?>


                 </tbody>
            </table>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- Logout Modal-->

      <!-- End of Main Content -->
