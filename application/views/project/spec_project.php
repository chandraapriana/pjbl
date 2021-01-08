
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


        <div class="col-lg-6">
          <?= $this->session->flashdata('message');?>
            <form method="post" action="<?= base_url('project/specproject')?>">
              <div class="form-group">
                <label for="judulProject">Judul Project</label>
                <input type="text" class="form-control" id="judulProject" name="judul" >
                <?= form_error('judul','<small class="text-danger pl-3">','</small>') ?>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Soal Warming Up</label>
                <select class="form-control" name="soalWarmingUp">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Banyak Kelompok</label>
                <select class="form-control" name="kelompok">
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Fase Project</label>
                <select class="form-control" id="exampleFormControlSelect1" name="fase">
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Kelas</label>
                <select class="form-control" name="kelas">
                  <option>X RPL - 1</option>
                  <option>X RPL - 2</option>
                  <option>X RPL - 3</option>
                  <option>X RPL - 4</option>
                  <option>X RPL - 5</option>
                  <option>X TKJ - 1</option>
                  <option>X TKJ - 2</option>
                  <option>X TKJ - 3</option>
                  <option>X TKJ - 4</option>
                  <option>X TKJ - 5</option>

                  <option>XI RPL - 1</option>
                  <option>XI RPL - 2</option>
                  <option>XI RPL - 3</option>
                  <option>XI RPL - 4</option>
                  <option>XI RPL - 5</option>
                  <option>XI TKJ - 1</option>
                  <option>XI TKJ - 2</option>
                  <option>XI TKJ - 3</option>
                  <option>XI TKJ - 4</option>
                  <option>XI TKJ - 5</option>

                  <option>XII RPL - 1</option>
                  <option>XII RPL - 2</option>
                  <option>XII RPL - 3</option>
                  <option>XII RPL - 4</option>
                  <option>XII RPL - 5</option>
                  <option>XII TKJ - 1</option>
                  <option>XII TKJ - 2</option>
                  <option>XII TKJ - 3</option>
                  <option>XII TKJ - 4</option>
                  <option>XII TKJ - 5</option>
                </select>
              </div>

              <button class="btn btn-primary" type="submit" name="specproject">Next</button>
            </form>

        </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
