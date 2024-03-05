<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');?>
<body>
  <h2 class="text-center"><?php echo lang('Form Siswa');?></h2>
  <form method="post" enctype="multipart/form-data" class="col-md-12 form-import-excel">
    <!-- ========================================== -->
    <!-- START STUDENT CLASS WITH EXCEL-->
    <!-- ========================================== -->
    <div class="form-group siswa">
      <label for="student_id">student id :</label>
      <input type="text" class="form-control input-file" name="student_id" <?php echo $input_post['student_id'] ?> required>
    </div>

    <div class="form-group siswa">
      <label for="class_id">class id :</label>
      <input type="text" class="form-control input-file" name="class_id" <?php echo $input_post['class_id'] ?> required>
    </div>

    <div class="form-group siswa">
      <label for="number">attendance number :</label>
      <input type="text" class="form-control input-file" name="number" <?php echo $input_post['number'] ?> required>
    </div>
    
    <div class="form-group">
      <label for="fileInput">Pilih File</label>
      <input type="file" name="file" class="form-control">
    </div>

    <div class="form-group">
      <button type="submit" name="import_excel" class="btn btn-primary col-md-12">Submit</button>
    </div>
  </form>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script>
    $(document).ready(function() {
      $('input.input-file').on('input', function() {
        var inputValue = $(this).val();
        var uppercaseValue = inputValue.toUpperCase();
        $(this).val(uppercaseValue);
      });
    });
  </script>
</body>