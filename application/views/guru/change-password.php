
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
          <div class="col-lg-4">
            <?= $this->session->flashdata('message');?>
          </div>
          <form action="<?= base_url('guru/changePassword')?>" method="post">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="exampleInputPassword1">Password Lama</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="passwordlama">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password Baru</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password1">
                <?= form_error('password1','<small class="text-danger pl-3">','</small>') ?>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Ulangi Password Baru</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password2">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>


          </form>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
