

  <div class="container" >

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-7">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">

              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">

                    <h1 class="h4 text-gray-900 mb-4">Masuk Sebagai</h1>
                  </div>
                  <div class="text-center">
                    <?= $this->session->flashdata('message');?>
                    <a href="<?=base_url('auth/login_guru') ?>" class="btn btn-primary">Guru</a>
                    <a href="<?=base_url('auth/login_siswa') ?>" class="btn btn-primary">Siswa</a>
                  </div>

                  <!-- <?= $this->session->flashdata('message');?> -->

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
