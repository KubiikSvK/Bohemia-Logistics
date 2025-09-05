<?php include '../includes/header.php'; ?>

<main class="gallery-page">
  <div class="container">
    <h1>Galerie</h1>
    <div class="gallery-grid">
      <?php
      $images = glob('../assets/img/gallery/*.jpg');
      foreach ($images as $index => $img) {
        $imgName = basename($img);
        echo '<div class="gallery-item">
                <img src="/assets/img/gallery/' . $imgName . '" alt="Gallery Image ' . $index . '" class="gallery-img" data-index="' . $index . '">
              </div>';
      }
      ?>
    </div>
  </div>

  <!-- Modal -->
  <div id="galleryModal" class="gallery-modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImage">
    <a class="prev">&#10094;</a>
    <a class="next">&#10095;</a>
  </div>
</main>

<?php include '../includes/footer.php'; ?>
<script src="/assets/js/modal.js"></script>