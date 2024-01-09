<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed'); ?>

<div class="col-md-8">
  <form id="form1" method="POST" role="form" enctype="multipart/form-data" class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1 class="panel-title">Tambah Guru</h1>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <label for="">Nama Guru</label>
          <input type="text" name="name" class="form-control input-file" id="" placeholder="Input field" required>
        </div>
        <div class="form-group">
          <label for="">NIP Guru</label>
          <input type="text" name="nip" class="form-control input-file" id="" placeholder="Input field" required>
        </div>
        <div class="form-group">
          <label for="">No HP Guru</label>
          <input type="text" name="phone" class="form-control input-file" id="" placeholder="Input field" required>
        </div>
        <div class="form-group">
          <label for="">Posisi Guru</label>
          <input type="text" name="position" class="form-control input-file" id="" placeholder="Input field" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit" value="submit_form1">Submit</button>
      </div>
    </div>
  </form>
</div>

<div class="col-md-4">
  <form id="form2" method="POST" role="form" enctype="multipart/form-data">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1 class="panel-title">Tambah Guru with Excel</h1>
      </div>
      <div class="panel-body">
        <p>Hiraukan Kolom A</p>
        <p>Jika Field dibawah ini tidak diisi, maka Nama Guru akan mengambil kolom B, NIP kolom C, NoHp kolom D, Posisi kolom E </p>
        <div class="form-group">
          <label for="">Field Nama Guru</label>
          <input type="text" name="name" class="form-control" id="" placeholder="Input field" value="<?php echo $data_excel['name'] ?>">
        </div>
        <div class="form-group">
          <label for="">Field NIP</label>
          <input type="text" name="nip" class="form-control" id="" placeholder="Input field" value="<?php echo $data_excel['nip'] ?>">
        </div>
        <div class="form-group">
          <label for="">Field Phone</label>
          <input type="text" name="phone" class="form-control" id="" placeholder="Input field" value="<?php echo $data_excel['phone'] ?>">
        </div>
        <div class="form-group">
          <label for="">Field Posisi</label>
          <input type="text" name="position" class="form-control" id="" placeholder="Input field" value="<?php echo $data_excel['position'] ?>">
        </div>
        <div class="form-group">
          <label for="fileInput">Pilih File</label>
          <input type="file" name="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit" value="submit_form2">Submit</button>
      </div>
    </div>
  </form>
</div>
