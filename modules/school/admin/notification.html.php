<?php if (!defined('_VALID_BBC')) exit('No direct script access allowed'); ?>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="notification-container">
          <form method="post" enctype="multipart/form-data" class="form-import-excel">
            <h1 class="text-center">PENGUMUMAN</h1>
            <div class="form-group">
              <label for="title">Title:</label>
              <input type="text" id="title" name="title" class="form-control">
            </div>
            <div class="form-group">
              <label for="message">Message:</label>
              <textarea id="message" name="message" class="form-control" rows="3" style="height: 300px;"></textarea>
            </div>
            <div class="form-group send">
              <button type="submit" class="btn btn-submit" name="btn-notification">send announcement</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>