
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

            <div class="container">
              <div class="col-lg-8">


              <?php for ($i=0; $i < count($project); $i++) :?>

                  <?php $no = $i+1 ?>
                  <h4><?=$no.".  ".$project[$i]['pertanyaan']?></h4>
                  <?php for ($j=0; $j < count($jawaban[0]); $j++) :?>
                    <div class="radio">
                      <div class="form-check">
                        <?php if ($jawaban[$i][$j]['id'] == $jawabanKelompokPG[$i]['id_jawaban_pg']): ?>
                          <input class="form-check-input" type="radio" name="jawaban<?=$i+1?>" value="<?= $jawaban[$i][$j]['id']?>" disabled checked>
                          <?php else: ?>
                          <input class="form-check-input" type="radio" name="jawaban<?=$i+1?>" value="<?= $jawaban[$i][$j]['id']?>" disabled>
                        <?php endif; ?>


                        <?php if ($jawaban[$i][$j]['id'] == $correctAnswer[$i]['id']): ?>
                          <label class="form-check-label form-control mb-3 bg-success" >
                            <?= $jawaban[$i][$j]['jawaban']?>
                          </label>
                        <?php else: ?>
                          <label class="form-check-label form-control mb-3" >
                            <?= $jawaban[$i][$j]['jawaban']?>
                          </label>
                        <?php endif; ?>
                      </div>
                    </div>

                  <?php endfor; ?>

              <?php endfor; ?>

                <a href="<?= base_url('siswa/project') ?>" class="btn btn-primary">Back</a>
              </div>
            </div>




        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
