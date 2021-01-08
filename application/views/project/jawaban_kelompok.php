
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
          <h3>Kelompok : <?= $kelompok['username']?></h3>
          <div class="col-lg-4">
            <?= $this->session->flashdata('message');?>
          </div>
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Fase</th>
                <th scope="col">Jawaban</th>
                <th scope="col">Nilai</th>
                <th scope="col">Evaluasi</th>
                <th scope="col">Penilaian</th>

              </tr>
            </thead>
            <?php if ($nilaiKelompok): ?>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Pertanyaan Dasar</td>
                <td>-</td>
                <td><?= $nilaiKelompok['nilai_pertanyaan_dasar'] ?></td>
                <td>-</td>
              </tr>
              <?php for ($i=0; $i < $banyakFase; $i++): ?>
                <tr>
                  <th scope="row"><?= $i+2 ?></td>
                  <td>fase <?= $i+1 ?></td>

                  <?php if ($i<count($jawabanFase) ): ?>
                    <td>
                      <a href="<?=base_url('assets/jawaban_fase/').strval($i+1)."/".$jawabanFase[$i]['nama_tugas'] ?>"><?= $jawabanFase[$i]['nama_tugas'] ?></a></td>
                    <td>
                      <?php $indexFase = "nilai_fase_".strval($i+1)?>
                      <?php if ($nilaiKelompok[$indexFase]): ?>
                        <?= $nilaiKelompok[$indexFase] ?>
                      <?php else: ?>
                        Belum Dinilai
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php $indexFase = "nilai_fase_".strval($i+1)?>
                      <?php if ($evalFase != "-"): ?>
                        <?php if ($i<count($evalFase)): ?>
                          <?= $evalFase[$i]['evaluasi'] ?>
                          <?php else: ?>
                            Belum Di Evaluasi
                        <?php endif; ?>
                      <?php else: ?>
                        Belum di Evaluasi
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if ($nilaiKelompok[$indexFase]): ?>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal<?= $i+1 ?>" data-whatever="@mdo">Edit Nilai Fase <?= $i+1 ?></button>
                      <?php else: ?>
                        <form class="" action="<?= base_url('project/input_nilai_fase/').strval($i+1)."/".$kelompok['id'] ?>" method="post">
                            <div class="input-group mb-3">
                              <input type="text" class="form-control" placeholder="Nilai" name="nilaiFase<?= $i+1 ?>".>
                              <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                              </div>
                            </div>

                        </form>
                      <?php endif; ?>

                      <?php if ($evalFase != "-" && $i<count($evalFase)): ?>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editEval<?= $i+1 ?>" data-whatever="@mdo">Edit Evaluasi Fase <?= $i+1 ?></button>
                      <?php else: ?>
                      <form class="mt-2" action="<?= base_url('project/input_nilai_evaluasi/').strval($i+1)."/".$kelompok['id'] ?>" method="post">

                          <div class="input-group mb-3">
                            <input type="textarea" class="form-control" placeholder="Evaluasi" name="evaluasiFase<?= $i+1 ?>".>
                            <div class="input-group-append">
                              <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                            </div>
                          </div>

                      </form>
                    <?php endif; ?>
                    </td>

                    <?php else: ?>
                      <td>Belum Mengerjakan</td>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>

                  <?php endif; ?>

                </tr>

                <div class="modal fade" id="exampleModal<?= $i+1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Nilai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="<?= base_url('project/edit_nilai_fase/').strval($i+1)."/".$kelompok['id'] ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Edit Nilai Fase:</label>
                              <input type="text" class="form-control" id="recipient-name" name="editNilai<?= $i+1 ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-warning">Edit Nilai</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <div class="modal fade" id="editEval<?= $i+1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Eval</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="<?= base_url('project/edit_evaluasi_fase/').strval($i+1)."/".$kelompok['id'] ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Edit Evaluasi Fase:</label>
                              <input type="text" class="form-control" id="recipient-name" name="editEvaluasiFase<?= $i+1 ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-warning">Edit Eval</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

              <?php endfor; ?>

              </tbody>
            </table>
        <?php else: ?>
        </table>
          <h1>KELOMPOK BELUM MEMULAI PROJECT</h1>
        <?php endif; ?>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
