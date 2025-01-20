<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed');

echo '<div class="col-md-6">';
$form = _lib('pea', 'school_student_class');
$form->initAdd();

$form->add->addInput('header', 'header');
$form->add->input->header->setTitle('Tambah Kelas Siswa');

$form->add->addInput('student_id', 'text');
$form->add->input->student_id->setTitle('ID Siswa');

$form->add->addInput('class_id', 'text');
$form->add->input->class_id->setTitle('ID Kelas');

$form->add->addInput('number', 'text');
$form->add->input->number->setTitle('Nomor Absen Siswa');


$form->add->action();

echo $form->add->getForm();
echo '</div>';
?>


<div class="col-md-6">
  <form method="POST" role="form" enctype="multipart/form-data" onsubmit="return validate_excel()">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Add Student with Excel</h3>
      </div>
      <div class="panel-body">
        <?php
        foreach ($fields as $key => $fieldName) {
          $label = ucwords(str_replace('_', ' ', $fieldName));
          echo '<div class="form-group">';
          // echo '<label for="">' . 'Field ' . $label . '</label>';
          echo '<input type="hidden" name="' . $fieldName . '" class="form-control input-file" id="" placeholder="Input field" value="' . $key . '">';
          echo '</div>';
        }
        ?>
        <div class="help-block">
          Upload File Excel
        </div>
        <div class="modal" id="preview-excel" style="background-color: white;">
          <div class="modal-dialog" style="max-width: 1000px; width: 100%;">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title">Preview Excel</h4>
              </div>

              <div class="modal-body">
                <div class="mb-3">
                  <label for="fileInput" class="form-label">Pilih File</label>
                  <input id="fileInput" name="file" type="file" class="form-control">
                </div>
                <div id="preview">
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary" name="import_excel" value="submit">
                    Submit
                  </button>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#preview-excel">Pilih File
        </button>
      </div>
    </div>
  </form>

  <div class="">
    <form action="" method="POST" class="form" role="form">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Template Excel</h3>
        </div>
        <div class="panel-body">
          <div class="help-block">
            Unduh Template Excel
          </div>
        </div>
        <div class="panel-footer">
          <button type="submit" name="template" value="download" class="btn btn-default">
            <?php echo icon('fa-file-excel-o') ?> Download Template
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php
echo '<div class="col-md-6">';
$form = _lib('pea',  'school_student');
$form->initSearch();
$form->search->addInput('keyword', 'keyword');
$form->search->input->keyword->addSearchField('name', false); //true = fulltext in database field

$add_sql = $form->search->action();
$keyword = $form->search->keyword();
echo $form->search->getForm();

$form->initRoll("$add_sql ORDER BY `id` DESC", 'id'); // ORDER BY wajib digunakan demi keamanan
$form->roll->setSaveTool(false);
$form->roll->setDeleteTool(false);

$form->roll->addInput('id', 'sqlplaintext');
$form->roll->input->id->setTitle('id');

$form->roll->addInput('name', 'sqlplaintext');
$form->roll->input->name->setTitle('Nama Siswa');

$form->roll->action();
echo $form->roll->getForm();
echo '</div>';

echo '<div class="col-md-6">';
$form = _lib('pea',  'school_class');

$form->initRoll("WHERE 1 ORDER BY `id` DESC", 'id'); // ORDER BY wajib digunakan demi keamanan
$form->roll->setSaveTool(false);
$form->roll->setDeleteTool(false);

$form->roll->addInput('id', 'sqlplaintext');
$form->roll->input->id->setTitle('id');

$form->roll->addInput('grade', 'sqlplaintext');
$form->roll->input->grade->setTitle('Kelas');

$form->roll->addInput('label', 'sqlplaintext');
$form->roll->input->label->setTitle('Label Kelas');

$form->roll->action();
echo $form->roll->getForm();
echo '</div>';
?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<script>
  $(document).ready(function() {
    $('input.input-file').on('input', function() {
      var inputValue = $(this).val();
      var uppercaseValue = inputValue.toUpperCase();
      $(this).val(uppercaseValue);
    });
  });

  function validate_excel() {
    var fileInput = document.querySelector('input[type="file"]');
    if (fileInput.files.length === 0) {
      alert("Masukkan file terlebih dahulu");
      return false;
    }
  }

  var expectedHeaders = ['No', 'ID Siswa', 'ID Kelas', 'Nomor Absen Siswa'];
  document.getElementById('fileInput').addEventListener('change', function(e) {
    var file = e.target.files[0];

    if (file) {
      var reader = new FileReader();

      reader.onload = function(e) {
        var data = new Uint8Array(e.target.result);
        var workbook = XLSX.read(data, {
          type: 'array'
        });

        // Ambil data dari sheet pertama
        var sheetName = workbook.SheetNames[0];
        var sheet = workbook.Sheets[sheetName];
        var headers = getHeaders(sheet);

        var isHeaderValid = checkHeaderValidity(headers);

        if (isHeaderValid) {

          // Convert data sheet ke array of objects
          var jsonData = XLSX.utils.sheet_to_json(sheet);
          console.log(jsonData);

          // Tampilin preview dalam bentuk tabel di div dengan id 'preview'
          var html = '<div class="table-responsive"><table class="table table-bordered"><thead><tr>';

          // Ambil nama kolom
          var columns = Object.keys(jsonData[0]);
          columns.forEach(function(column) {
            html += '<th>' + column + '</th>';
          });

          html += '</tr></thead><tbody>';

          // Isi data ke dalam tabel
          jsonData.forEach(function(row) {
            html += '<tr>';
            columns.forEach(function(column) {
              html += '<td>' + row[column] + '</td>';
            });
            html += '</tr>';
          });

          html += '</tbody></table>';
          // Tampilin tabel di div dengan id 'preview' dengan tambahan border
          document.getElementById('preview').innerHTML = html;
        } else {
          document.getElementById('preview').innerHTML = '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" title="ok sign"></span> Maaf, format excel yang anda upload tidak sesuai, Silahkan donwload template yang sudah di sediakan.</div>';
        }
      };

      reader.readAsArrayBuffer(file);

      function getHeaders(sheet) {
        var headers = [];
        var range = XLSX.utils.decode_range(sheet['!ref']);
        var C;

        for (C = range.s.c; C <= range.e.c; ++C) {
          var cell = sheet[XLSX.utils.encode_cell({
            r: range.s.r,
            c: C
          })];
          var header = cell.v;
          headers.push(header.toLowerCase()); // Mengonversi header ke huruf kecil
        }

        return headers;
      }

      function checkHeaderValidity(headers) {
        return expectedHeaders.every(function(header) {
          return headers.includes(header.toLowerCase());
        });
      }

    }
  });
</script>
</body>