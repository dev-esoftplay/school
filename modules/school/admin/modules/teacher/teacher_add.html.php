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
                    <input type="text" name="name" class="form-control input-file" maxlength="255" placeholder="Input field"
                        required>
                </div>
                <div class="form-group">
                    <label for="">Gender Guru</label>

                    <div class="form-group">
                        <label class="radio-inline">
                            <input type="radio" id="male" name="gender" value="1"> Laki-Laki
                        </label>
                        <label class="radio-inline">
                            <input type="radio" id="female" name="gender" value="2"> Perempuan
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">NIP Guru</label>
                    <input type="text" maxlength="18" name="nip" class="form-control input-file"
                        placeholder="Input field"
                        required>
                </div>
                <div class="form-group">
                    <label for="">No HP Guru</label>
                    <input type="number" maxlength="14" name="phone" class="form-control input-file"
                        placeholder="Input field"
                        required>
                </div>
                <div class="form-group">
                    <label for="">Posisi Guru</label>
                    <input type="text" name="position" class="form-control input-file" maxlength="255" placeholder="Input field"
                        required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal Lahir</label>
                    <input type="date" id="tanggal" name="birthday" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary col-md-12" name="submit" value="submit_form1">Submit</button>
                </div>
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
                <!-- <p>Hiraukan Kolom A</p> -->
                <!-- <p>Jika Field dibawah ini tidak diisi, maka Nama Guru akan mengambil kolom B, NIP kolom C, NoHp kolom D, Posisi kolom E </p> -->
                <div class="form-group">
                    <!-- <label for="">Field Nama Guru</label> -->
                    <input type="hidden" name="name" class="form-control" id="" placeholder="Input field"
                        value="<?php echo $data_excel['name'] ?>">
                </div>
                <div class="form-group">
                    <!-- <label for="">Field Gender</label> -->
                    <input type="hidden" name="gender" class="form-control" id="" placeholder="Input field"
                        value="<?php echo $data_excel['gender'] ?>">
                </div>
                <div class="form-group">
                    <!-- <label for="">Field NIP</label> -->
                    <input type="hidden" name="nip" class="form-control" id="" placeholder="Input field"
                        value="<?php echo $data_excel['nip'] ?>">
                </div>
                <div class="form-group">
                    <!-- <label for="">Field Phone</label> -->
                    <input type="hidden" name="phone" class="form-control" id="" placeholder="Input field"
                        value="<?php echo $data_excel['phone'] ?>">
                </div>
                <div class="form-group">
                    <!-- <label for="">Field Posisi</label> -->
                    <input type="hidden" name="position" class="form-control" id="" placeholder="Input field"
                        value="<?php echo $data_excel['position'] ?>">
                </div>
                <div class="form-group">
                    <!-- <label for="">Field Tanggal Lahir</label> -->
                    <input type="hidden" name="birthday" class="form-control" id="" placeholder="Input field"
                        value="<?php echo $data_excel['birthday'] ?>">
                </div>
                <div class="help-block">
                    Upload File Excel
                </div>

                <div class="modal" id="preview-excel" style="background-color: white;">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title">Preview Excel</h4>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Pilih file</label>
                                    <input type="file" class="form-control" id="fileInput" name="file">
                                </div>
                                <div id="preview">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" name="submit" value="submit_form2">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div>
<div class="">
    <form action="<?php echo site_url('school/teacher') ?>" method="POST" class="form" role="form">
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
                <button type="submit" name="template" value="download"
                    class="btn btn-default"><?php echo icon('fa-file-excel-o') ?> Download Template
                </button>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<script>
    var expectedHeaders = ['No', 'Nama', 'NIP', 'No HP', 'Posisi', 'Tanggal Lahir'];
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

                console.log(headers);

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