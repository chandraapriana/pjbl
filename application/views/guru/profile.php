        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
          <div class="col-lg-4">
            <?= $this->session->flashdata('message');?>
          </div>
          <div class="card" style="width: 25rem;">
            <div class="card-body">
              <table
                <tr>
                  <td><h5 class="card-title mr-4">Profesi</h5></td>
                  <td><h5 class="card-title">: Guru</h5></td>
                </tr>
                <tr>
                  <td><h5 class="card-title">Nama</h5></td>
                  <td><h5 class="card-title">: <?= $user['nama'] ?></h5></td>
                </tr>
                <tr>
                  <td><p class="card-title">Username</p></td>
                  <td><p class="card-title">: <?= $user['username'] ?></p></td>
                </tr>
                <tr>
                  <td><p class="card-title">Email</p></td>
                  <td><p class="card-title">: <?= $user['email'] ?></p></td>
                </tr>
                <tr>
                  <td><p class="card-title">No Telp</p></td>
                  <td><p class="card-title">: <?= $user['notelp'] ?></p></td>
                </tr>
              </table>

              <a href="editprofile" class="btn btn-warning">Edit</a>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
