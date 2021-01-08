
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
          <form  action="<?= base_url('siswa/pertanyaan_dasar') ?>" method="post">
            <div class="container">
              <div class="col-lg-8">


              <?php for ($i=0; $i < count($project); $i++) :?>

                  <?php $no = $i+1 ?>
                  <h4><?=$no.".  ".$project[$i]['pertanyaan']?></h4>
                  <?php for ($j=0; $j < count($jawaban[0]); $j++) :?>
                    <div class="radio">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="jawaban<?=$i+1?>" value="<?= $jawaban[$i][$j]['id']?>">
                        <label class="form-check-label form-control mb-3" >
                          <?= $jawaban[$i][$j]['jawaban']?>
                        </label>
                      </div>
                    </div>

                  <?php endfor; ?>

              <?php endfor; ?>
                <button type="submit" class="btn btn-primary" name="pilihanGanda">Submit</button>
              </div>
            </div>

          </form>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
