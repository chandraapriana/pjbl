
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

          <div class="col-lg-6">
          <?php if ($listKelas): ?>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Kelas</th>
                </tr>
              </thead>
              <tbody>
                  <?php $no = 1 ?>
                  <?php foreach ($listKelas as $lk): ?>
                    <tr>
                      <th scope="row"><?= $no ?></th>
                      <td><a  href="<?=base_url('project/listproject/').$lk['kelas']?>"><?= $lk['kelas'] ?></a></td>
                    </tr>
                    <?php $no = $no + 1 ?>
                  <?php endforeach; ?>
              </tbody>
            </table>
          <?php else: ?>
            <h1>Belum Membuat Project</h1>
          <?php endif; ?>
          </div>



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
