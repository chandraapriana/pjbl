




        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
          <form action="<?= base_url('guru/editprofile') ?>" method="post">
            <div class="card" style="width: 26rem;">
              <div class="card-body">

                  <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="inputPassword" name="nama" value="<?=$user['nama'] ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">No Telp</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="inputPassword" name="notelp" value="<?=$user['notelp'] ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-8">
                      <input disabled type="text" class="form-control" id="inputPassword" name="username" value="<?=$user['username'] ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-8">
                      <input disabled type="text" class="form-control" id="inputPassword" name="username" value="<?=$user['email'] ?>">
                    </div>
                  </div>
                  <button type="submit" name="edit" class="btn btn-warning">Edit</button>
              </div>

            </div>



          </form>




        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
