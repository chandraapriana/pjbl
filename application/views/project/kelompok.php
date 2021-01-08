
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Username</th>
                <th scope="col">Anggota</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php for ($i=0; $i < $banyakKelompok ; $i++): ?>
                <tr>
                  <th scope="row">1</th>
                  <td><?= $kelompok[$i]['username'] ?></td>
                  <td><?= $kelompok[$i]['anggota'] ?></td>
                  <td><a href="<?= base_url('project/jawaban_kelompok/'.$kelompok[$i]['id']) ?>" class="btn btn-primary">Lihat Jawaban</a></td>
                </tr>
              <?php endfor; ?>


            </tbody>
          </table>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
