
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

        <div class="col-lg-6">
            <?= $this->session->flashdata('message');?>
            <form class="" action="<?= base_url('project/BuatProject')?>" method="post" enctype="multipart/form-data">
              <input type="text" hidden name="judul" value="<?= $judul ?>">
              <input type="text" hidden name="soalWarmingUp" value="<?=$banyakSoal?>">
              <input type="text" hidden name="kelompok" value="<?= $banyakKelompok?>">
              <input type="text" hidden name="fase" value="<?= $banyakFase?>">


              <h1><?= $judul?></h1>
              <h2><?= $kelas?></h2>

              <?php for ($i=1; $i <= $banyakSoal ; $i++) :?>
              <div class="form-group mb-4">
                <label class="font-weight-bold" for="judulProject">Pertanyaan No <?=$i ?></label>
                <input type="text" class="form-control" id="judulProject" name="judulPertanyaan<?=$i?>" placeholder="" value="<?= set_value('judulPertanyaan'.$i)?>">
                <?= form_error('judulPertanyaan'.$i,'<small class="text-danger pl-3">','</small>') ?>
                <div class="input-group mb-2 mt-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">A</div>
                  </div>
                  <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Masukan Jawaban..." name="jawabanA<?=$i?>" value="<?= set_value('jawabanA'.$i)?>">
                </div>
                <?= form_error('jawabanA'.$i,'<small class="text-danger pl-3">','</small>') ?>
                <div class="input-group mb-2 mt-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">B</div>
                  </div>
                  <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Masukan Jawaban..." name="jawabanB<?=$i?>" value="<?= set_value('jawabanB'.$i)?>">
                </div>
                <?= form_error('jawabanB'.$i,'<small class="text-danger pl-3">','</small>') ?>
                <div class="input-group mb-2 mt-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">C</div>
                  </div>
                  <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Masukan Jawaban..." name="jawabanC<?=$i?>" value="<?= set_value('jawabanC'.$i)?>">
                </div>
                <?= form_error('jawabanC'.$i,'<small class="text-danger pl-3">','</small>') ?>
                <div class="input-group mb-2 mt-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">D</div>
                  </div>
                  <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Masukan Jawaban..." name="jawabanD<?=$i?>" value="<?= set_value('jawabanD'.$i)?>">
                </div>
                <?= form_error('jawabanD'.$i,'<small class="text-danger pl-3">','</small>') ?>
              </div>
              <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-5 col-form-label">Jawaban Yang Benar... </label>
                  <div class="form-group">
                      <select class="form-control" id="exampleFormControlSelect1" name="correct">
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                      </select>
                    </div>
                </div>

            <?php endfor;?>

            <hr class="sidebar-divider">

            <?php for ($i=1; $i <= $banyakKelompok ; $i++) :?>
              <div class="form-group">
                <label class="font-weight-bold" for="judulProject">Kelompok <?=$i ?></label>
                <input type="text" class="form-control mb-2" id="judulProject" name="usernameKel<?=$i ?>" placeholder="Username..." value="<?= set_value('usernameKel'.$i)?>">
                <?= form_error('usernameKel'.$i,'<small class="text-danger pl-3">','</small>') ?>
                <input type="text" class="form-control" id="judulProject" name="passwordKel<?=$i ?>" placeholder="Password..." value="<?= set_value('passwordKel'.$i)?>">
                <?= form_error('passwordKel'.$i,'<small class="text-danger pl-3">','</small>') ?>
              <div class="form-group">
                  <textarea class="mt-2 form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Anggota-anggota..." name="anggotaKel<?=$i?>" value="<?= set_value('anggotaKel'.$i)?>"><?= set_value('anggotaKel'.$i)?></textarea>
                  <?= form_error('anggotaKel'.$i,'<small class="text-danger pl-3">','</small>') ?>
              </div>
            <?php endfor;?>

            <hr class="sidebar-divider">

            <?php for ($i=1; $i <= $banyakFase ; $i++) :?>
              <div class="form-group">
                <label class="font-weight-bold" for="judulProject">Fase <?=$i ?></label>
                <textarea class="form-control mb-2" id="exampleFormControlTextarea1" rows="3" placeholder="Instruksi-instruksi..." name="instruksiProject<?=$i?>" value="<?= set_value('instruksiProject'.$i)?>"><?= set_value('instruksiProject'.$i)?></textarea>
                <?= form_error('instruksiProject'.$i,'<small class="text-danger pl-3">','</small>') ?>
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="validatedCustomFile" required name="bahanProject<?=$i?>" value="<?= set_value('bahanProject'.$i)?>">
                    <label class="custom-file-label" for="validatedCustomFile">Bahan Bahan...</label>
                    <?= form_error('bahanProject'.$i,'<small class="text-danger pl-3">','</small>') ?>
                </div>
                <div class="form-group row">
                  <label for="example-datetime-local-input" class="col-3 col-form-label">Batas Awal</label>
                  <div class="col-9">
                    <input class="form-control" type="datetime-local" value="<?= set_value('batasAwal'.$i)?>" id="example-datetime-local-input" name="batasAwal<?=$i?>" >
                      <?= form_error('batasAwal'.$i,'<small class="text-danger pl-3">','</small>') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="example-date-input" class="col-3 col-form-label">Batas Akhir</label>
                  <div class="col-9">
                    <input class="form-control" type="datetime-local" id="example-date-input" name="tanggalProject<?=$i?>" value="<?=set_value('tanggalProject'.$i)?>">
                    <?= form_error('tanggalProject'.$i,'<small class="text-danger pl-3">','</small>') ?>
                  </div>
                </div>
              </div>

            <?php endfor;?>
            <input type="text" hidden name="next" value="next">

              <button class="btn btn-primary mb-3" type="submit" name="secondProject">Next</button>
            </form>



        </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
