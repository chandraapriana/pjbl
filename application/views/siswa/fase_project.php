
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

          <table class="table table-striped">
            <tbody>
              <tr>
                <td width=200;>Instruksi</td>
                <td>: <?=$project['instruksi']?></td>
              </tr>
              <tr>
                <td>File</td>
                <td>: <a href="<?= base_url('assets/bahan_project/').$project['bahan'] ?>"><?= $project['bahan'] ?></a></td>
              </tr>
              <tr>
                <td>Waktu Pengumpulan</td>
                <td>:  <b><?= $project['startline'] ?> </b> S/D <b> <?= $project['deadline'] ?></b></td>
              </tr>
              <tr>
                <td>Upload Tugas</td>
                <td>
                  <div class="col-lg-8 mt-0">
                    <?php if (!$jawabanFase): ?>
                      <form class="" action="<?= base_url('siswa/fase_project/').$faseProject ?>" method="post" enctype="multipart/form-data">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="validatedCustomFile" required name="uploadTugas" value="<?= set_value('uploadTugas')?>">
                            <label class="custom-file-label" for="validatedCustomFile">Bahan Bahan...</label>
                        </div>
                        <input type="text" name="tugas" value="submit" hidden>
                        <button type="submit" name="submitTugas" class="btn btn-primary mt-2">Submit</button>
                      </form>
                    <?php else: ?>
                      <?php $end    = new DateTime($project['deadline']);
                            $today = new DateTime(); ?>
                      <?php if ($today<$end): ?>
                        <form class="" action="<?= base_url('siswa/delete_jawaban/').$faseProject ?>" method="post" enctype="multipart/form-data">
                          <a href="<?= base_url('assets/jawaban_fase/').$faseProject."/".$jawabanFase['nama_tugas'] ?>"><?= $jawabanFase['nama_tugas'] ?></a>
                          <button type="submit" name="submitTugas" class="btn btn-danger mt-2">Delete</button>
                        </form>
                        <?php else: ?>
                          <a href="<?= base_url('assets/jawaban_fase/').$faseProject."/".$jawabanFase['nama_tugas'] ?>"><?= $jawabanFase['nama_tugas'] ?></a>
                      <?php endif; ?>

                    <?php endif; ?>

                  </div>


                </td>
              </tr>
             </tbody>
             </table>

             <!-- <form action="/action_page.php">
               <div class="form-group row">
                 <label for="example-datetime-local-input" class="col-2 col-form-label">Date and time</label>
                 <div class="col-10">
                   <input class="form-control" type="datetime-local" value="2011-08-19T13:45:00" id="example-datetime-local-input">
                 </div>
               </div>
             </form> -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
