




        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
          <div class="card col-lg-6" >
            <div class="card-body">
              <table>
                <tr>
                  <td><h5 class="card-subtitle mb-3 text-muted">Guru</h5></td>
                  <td><h5 class="card-subtitle mb-3 text-muted">: <?= $guru['nama'] ?></h5></td>
                </tr>
                <tr>
                  <td><h5 class="card-subtitle mb-3 text-muted">No Telp Guru</h5></td>
                  <td><h5 class="card-subtitle mb-3 text-muted">: <?= $guru['notelp'] ?></h5></td>
                </tr>
                <tr>
                  <td><h5 class="card-title">Username</h5></td>
                  <td><h5 class="card-title">: <?= $user['username'] ?></h5></td>
                </tr>
                <tr>
                  <td><p class="card-text">Anggota</p></td>
                  <td><p class="card-text">: <?= $user['anggota'] ?></p></td>
                </tr>
              </table>

            </div>
          </div>




        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
