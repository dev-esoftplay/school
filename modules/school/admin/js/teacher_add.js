src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"

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

      // Convert data sheet ke array of objects
      var jsonData = XLSX.utils.sheet_to_json(sheet);

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
    };

    reader.readAsArrayBuffer(file);
  }
});
