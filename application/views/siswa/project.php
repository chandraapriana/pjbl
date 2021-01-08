
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
          <h2 class="h5 mb-4 text-gray-800">Judul Project : <?= $project['nama_project'] ?></h2>

          <div class="col-lg-4">
            <?= $this->session->flashdata('message');?>
          </div>
          <div class="col-lg-12 col-sm-12">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Fase</th>
                  <th scope="col">Waktu Batas Awal</th>
                  <th scope="col">Waktu Batas Akhir</th>
                  <th scope="col">Status</th>
                  <th scope="col">Nilai</th>
                  <th scope="col">Evaluasi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Pertanyaan Dasar</td>
                  <td>-</td>
                  <td>-</td>
                  <?php if (!$nilai): ?>
                    <td><a href="<?= base_url('siswa/pertanyaan_dasar') ?>" class="btn btn-warning">Belum Selesai</a></td>
                  <?php else: ?>
                    <td><a href="<?= base_url('siswa/pertanyaan_dasar_selesai') ?>" class="btn btn-success">Sudah Selesai</a></td>
                  <?php endif; ?>

                  <td><?php if ($nilai): ?>
                    <?=$nilai['nilai_pertanyaan_dasar']?></td>
                  <?php else: ?>
                      Belum Mengerjakan
                  <?php endif; ?>

                </tr>

                <?php for ($i=0; $i < count($faseProjectKel) ; $i++) : ?>
                  <tr>
                    <th scope="row"><?= $i+2?></th>
                    <td>Fase <?= $i+1 ?></td>
                    <td><?= $faseProjectKel[$i]['startline']?></td>
                    <td><?= $faseProjectKel[$i]['deadline']?></td>
                    <td>

                      <?php
                        $start  = new DateTime($faseProjectKel[$i]['startline']);
                        $end    = new DateTime($faseProjectKel[$i]['deadline']);
                        $today = new DateTime();
                       ?>

                      <?php if ($nilai): ?> <!--Jika PG sudah dijawab -->
                        <?php if ($today>= $start && $today < $end): ?> <!--Jika Sudah Memasuki waktu fase -->
                          <?php if ($jawabanFase && $i<count($jawabanFase)): ?> <!--Jika PG sudah dijawab -->
                            <a href="<?= base_url('siswa/fase_project/').$faseProjectKel[$i]['fase'] ?>" class="btn btn-success">Sudah Terkirim</a>
                          <?php else: ?>
                            <a href="<?= base_url('siswa/fase_project/').$faseProjectKel[$i]['fase'] ?>" class="btn btn-warning">Belum Selesai</a>
                          <?php endif; ?>
                        <?php else: ?>
                          <?php if ($i<count($jawabanFase)): ?>
                            <?php if ($jawabanFase[$i]['fase']): ?>
                              <a href="<?= base_url('siswa/fase_project/').$faseProjectKel[$i]['fase'] ?>" class="btn btn-success" >Sudah Selesai</a>
                              <?php else: ?>
                                <p href="#" class="btn btn-secondary btn-default active" >Terlewat</p>
                            <?php endif; ?>
                            <?php else: ?>
                              <?php if ($today<$end): ?>
                                <p class="btn btn-dark btn-default active" >Belum Mulai</p>
                                <?php else: ?>
                                  <p href="#" class="btn btn-secondary btn-default active" >Terlewat</p>
                              <?php endif; ?>

                          <?php endif; ?>
                        <?php endif; ?>
                      <?php else: ?>
                        <!-- <a href="#" class="btn btn-dark" >Belum Mulai</a> -->
                        <p class="btn btn-dark btn-default active" >Belum Mulai</p>
                      <?php endif; ?>

                    </td>
                    <td>
                      <?php if ($nilai): ?>
                        <?php if ($nilai['nilai_fase_'.strval($i+1)]): ?>
                          <?= $nilai['nilai_fase_'.strval($i+1)] ?>
                        <?php else: ?>
                            Belum Dinilai
                        <?php endif; ?>
                      <?php else: ?>
                            Belum Mengirim
                      <?php endif; ?>

                    </td>
                    <td>
                      <?php if ($evalFase!="-"): ?>
                        <?php if ($i < count($evalFase)): ?>
                          <?= $evalFase[$i]['evaluasi'] ?>
                          <?php else: ?>
                            <?="Belum Di Evaluasi" ?>
                        <?php endif; ?>
                        <?php else: ?>
                          <?="Belum Di Evaluasi" ?>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endfor; ?>


              </tbody>
            </table>

          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
