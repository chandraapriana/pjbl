
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

        <div class="col-lg-6">
          <?= $this->session->flashdata('message');?>
          <form class="" action="<?= base_url('project/edit_project/').$project['id']?>" method="post" enctype="multipart/form-data">

            <input type="text" hidden name="banyakSoal" value="<?= $banyakSoal ?>">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Judul</span>
            </div>
            <input type="text" class="form-control" placeholder="Judul" aria-label="Username" aria-describedby="basic-addon1" value="<?= $project['nama_project']?> "name="judul">
          </div>

          <div class="form-group">
            <label for="exampleFormControlSelect1">Kelas</label>
            <select class="form-control" name="kelas">
              <?php for ($i=0;$i<count($kelas);$i++): ?>
                <?php if ($kelas[$i]==$project['kelas']): ?>
                  <option selected><?= $kelas[$i] ?></option>
                  <?php else: ?>
                    <option><?= $kelas[$i] ?></option>
                <?php endif; ?>

              <?php endfor; ?>
            </select>

          </div>


              <?php for ($i=1; $i <= $banyakSoal ; $i++) :?>
              <div class="form-group mb-4">
                <label class="font-weight-bold" for="judulProject">Pertanyaan No <?=$i ?></label>
                <input type="text" class="form-control" id="judulProject" name="judulPertanyaan<?=$i?>" placeholder="" value="<?=$pertanyaanDasar[$i-1]['pertanyaan']?>" >
                <?= form_error('judulPertanyaan'.$i,'<small class="text-danger pl-3">','</small>') ?>
                <div class="input-group mb-2 mt-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">A</div>
                  </div>
                  <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Masukan Jawaban..." name="jawabanA<?=$i?>" value="<?= $jawabanPG[$i-1][0]['jawaban']?>" >
                </div>
                <?= form_error('jawabanA'.$i,'<small class="text-danger pl-3">','</small>') ?>
                <div class="input-group mb-2 mt-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">B</div>
                  </div>
                  <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Masukan Jawaban..." name="jawabanB<?=$i?>" value="<?= $jawabanPG[$i-1][1]['jawaban']?>" >
                </div>
                <?= form_error('jawabanB'.$i,'<small class="text-danger pl-3">','</small>') ?>
                <div class="input-group mb-2 mt-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">C</div>
                  </div>
                  <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Masukan Jawaban..." name="jawabanC<?=$i?>" value="<?= $jawabanPG[$i-1][2]['jawaban']?>" >
                </div>
                <?= form_error('jawabanC'.$i,'<small class="text-danger pl-3">','</small>') ?>
                <div class="input-group mb-2 mt-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">D</div>
                  </div>
                  <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Masukan Jawaban..." name="jawabanD<?=$i?>" value="<?= $jawabanPG[$i-1][3]['jawaban']?>" >
                </div>
                <?= form_error('jawabanD'.$i,'<small class="text-danger pl-3">','</small>') ?>
              </div>
              <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-5 col-form-label">Jawaban Yang Benar... </label>
                  <div class="form-group">
                      <select class="form-control" id="exampleFormControlSelect1" name="correct" >
                        <?php for ($j=0; $j < 4 ; $j++) :?>
                          <?php if ($jawabanPG[$i-1][$j]['correct'] == 1): ?>
                            <option selected><?=$jawabanPG[$i-1][$j]['pilihan']?></option>
                          <?php else : ?>
                            <option ><?=$jawabanPG[$i-1][$j]['pilihan']?></option>
                          <?php endif; ?>
                        <?php endfor; ?>
                      </select>
                    </div>
                </div>

            <?php endfor;?>

            <hr class="sidebar-divider">

            <?php for ($i=1; $i <= $banyakKelompok ; $i++) :?>
              <div class="form-group">
                <label class="font-weight-bold" for="judulProject">Kelompok <?=$i ?></label>
                <input type="text" class="form-control mb-2" id="judulProject" name="usernameKel<?=$i ?>" placeholder="Username..." value="<?= $kelompok[$i-1]['username'] ?>" >
                <?= form_error('usernameKel'.$i,'<small class="text-danger pl-3">','</small>') ?>
                <input type="text" class="form-control" id="judulProject" name="passwordKel<?=$i ?>" placeholder="Password..." value="<?= base64_decode($kelompok[$i-1]['password']) ?>" >
                <?= form_error('passwordKel'.$i,'<small class="text-danger pl-3">','</small>') ?>
              <div class="form-group">
                  <textarea class="form-control mt-2" id="exampleFormControlTextarea1" rows="3" placeholder="Anggota-anggota..." name="anggotaKel<?=$i?>" ><?= $kelompok[$i-1]['anggota'] ?></textarea>
                  <?= form_error('anggotaKel'.$i,'<small class="text-danger pl-3">','</small>') ?>
              </div>
            <?php endfor;?>

            <hr class="sidebar-divider">



            <?php for ($i=1; $i <= $banyakFase ; $i++) :?>
              <div class="form-group">
                <label class="font-weight-bold" for="judulProject">Fase <?=$i ?></label>
                <textarea class="form-control mb-2" id="exampleFormControlTextarea1" rows="3" placeholder="Instruksi-instruksi..." name="instruksiProject<?=$i?>" ><?= $fase[$i-1]['instruksi'] ?></textarea>
                <?= form_error('instruksiProject'.$i,'<small class="text-danger pl-3">','</small>') ?>
                <div class="custom-file mb-3">

                    <input type="file" class="custom-file-input" id="validatedCustomFile"  name="bahanProject<?=$i?>" value="<?= $fase[$i-1]['bahan'] ?>" >
                    <label class="custom-file-label" for="validatedCustomFile"><?= $fase[$i-1]['bahan'] ?></label>
                    <?= form_error('bahanProject'.$i,'<small class="text-danger pl-3">','</small>') ?>
                </div>

              </div>
              <div class="form-group row">
                <label for="example-datetime-local-input" class="col-3 col-form-label">Batas Awal</label>
                <div class="col-9">
                  <input class="form-control" type="datetime-local" value="<?= (new DateTime($fase[$i-1]['startline']))->format('Y-m-d\TH:i:s') ?>"id="example-datetime-local-input" name="batasAwal<?=$i?>" >
                    <?= form_error('batasAwal'.$i,'<small class="text-danger pl-3">','</small>') ?>
                </div>
              </div>
              <div class="form-group row">
                <label for="example-date-input" class="col-3 col-form-label">Batas Akhir</label>
                <div class="col-9">
                  <?php $time = $fase[$i-1]['deadline'] ?>
                  <input class="form-control" type="datetime-local" id="example-date-input" name="tanggalProject<?=$i?>" value="<?= (new DateTime($fase[$i-1]['deadline']))->format('Y-m-d\TH:i:s') ?>" >
                  <?= form_error('tanggalProject'.$i,'<small class="text-danger pl-3">','</small>') ?>
                </div>
              </div>

            <?php endfor;?>

            <a href="<?= base_url('Project/listProject/'.$project['kelas']) ?>" class="btn btn-primary">Back</a>
            <button type="submit" class="btn btn-warning" name="edit"><b>Edit</b></button>

            </form>


        </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
