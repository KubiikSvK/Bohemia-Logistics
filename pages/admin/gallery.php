<?php 
require_once '../../config.php';
requireAdmin();
include 'admin-header.php'; 

$galleryPath = '/var/www/bml.vanekgroup.eu/assets/img/gallery/';
$images = glob($galleryPath . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
?>
<div class="admin-dashboard container">
  <h1>Správa galerie</h1>

  <div class="form-section">
    <h2>Nahrát nové obrázky</h2>
    <p class="text-light" style="font-size: 0.9em; margin-bottom: 15px;">
      Max. velikost souboru: <?= ini_get('upload_max_filesize') ?> | 
      Max. celková velikost: <?= ini_get('post_max_size') ?>
    </p>
    
    <div style="display: flex; gap: 20px; margin-bottom: 20px;">
      <button type="button" id="singleBtn" class="upload-mode-btn active">Jednotlivý obrázek</button>
      <button type="button" id="zipBtn" class="upload-mode-btn">ZIP archiv</button>
    </div>
    
    <form id="uploadForm">
      <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
      <div class="form-group" id="singleUpload">
        <label class="form-label text-light">Vyberte obrázek (max 3MB)</label>
        <input type="file" id="imageFile" name="image" accept="image/jpeg,image/jpg,image/png,image/gif">
      </div>
      <div class="form-group" id="zipUpload" style="display: none;">
        <label class="form-label text-light">Vyberte ZIP archiv s obrázky (max 10MB)</label>
        <input type="file" id="zipFile" name="zip" accept=".zip">
      </div>
      <button type="button" id="uploadBtn">Nahrát</button>
      <div id="uploadStatus" class="text-light" style="margin-top: 10px;"></div>
    </form>
    
    <script>
    // Mode switching
    document.getElementById('singleBtn').onclick = function() {
      document.getElementById('singleUpload').style.display = 'block';
      document.getElementById('zipUpload').style.display = 'none';
      document.getElementById('singleBtn').classList.add('active');
      document.getElementById('zipBtn').classList.remove('active');
    };
    
    document.getElementById('zipBtn').onclick = function() {
      document.getElementById('singleUpload').style.display = 'none';
      document.getElementById('zipUpload').style.display = 'block';
      document.getElementById('zipBtn').classList.add('active');
      document.getElementById('singleBtn').classList.remove('active');
    };
    
    function compressImage(file, maxSizeKB = 500) {
      return new Promise((resolve) => {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        const img = new Image();
        
        img.onload = function() {
          // Calculate new dimensions
          let { width, height } = img;
          const maxDim = 1200;
          
          if (width > height && width > maxDim) {
            height = (height * maxDim) / width;
            width = maxDim;
          } else if (height > maxDim) {
            width = (width * maxDim) / height;
            height = maxDim;
          }
          
          canvas.width = width;
          canvas.height = height;
          
          ctx.drawImage(img, 0, 0, width, height);
          
          // Try different quality levels
          let quality = 0.8;
          canvas.toBlob(function(blob) {
            if (blob.size > maxSizeKB * 1024 && quality > 0.1) {
              quality -= 0.1;
              canvas.toBlob(resolve, 'image/jpeg', quality);
            } else {
              resolve(blob);
            }
          }, 'image/jpeg', quality);
        };
        
        img.src = URL.createObjectURL(file);
      });
    }
    
    document.getElementById('uploadBtn').onclick = async function() {
      const form = document.getElementById('uploadForm');
      const status = document.getElementById('uploadStatus');
      const isZipMode = document.getElementById('zipUpload').style.display !== 'none';
      
      if (isZipMode) {
        const zipFile = document.getElementById('zipFile').files[0];
        if (!zipFile) {
          status.textContent = 'Vyberte ZIP soubor';
          return;
        }
        
        const formData = new FormData();
        formData.append('zip', zipFile);
        formData.append('csrf_token', form.csrf_token.value);
        
        status.textContent = 'Nahrávám ZIP...';
        
        try {
          const response = await fetch('/actions/upload-zip.php', {
            method: 'POST',
            body: formData
          });
          
          const data = await response.json();
          
          if (data.success) {
            status.textContent = `ZIP extrahován! Nahráno ${data.count} obrázků.`;
            setTimeout(() => location.reload(), 2000);
          } else {
            status.textContent = 'Chyba: ' + data.error;
          }
        } catch (error) {
          status.textContent = 'Chyba při zpracování ZIP';
        }
      } else {
        const file = document.getElementById('imageFile').files[0];
        if (!file) {
          status.textContent = 'Vyberte soubor';
          return;
        }
        
        status.textContent = 'Komprimuji obrázek...';
        
        try {
          const compressedFile = await compressImage(file, 400);
          
          const formData = new FormData();
          formData.append('image', compressedFile, 'compressed.jpg');
          formData.append('csrf_token', form.csrf_token.value);
          
          status.textContent = 'Nahrávám...';
          
          const response = await fetch('/actions/upload-single-image.php', {
            method: 'POST',
            body: formData
          });
          
          if (!response.ok) {
            throw new Error('HTTP ' + response.status);
          }
          
          const data = await response.json();
          
          if (data.success) {
            status.textContent = 'Obrázek nahrán úspěšně!';
            setTimeout(() => location.reload(), 1000);
          } else {
            status.textContent = 'Chyba: ' + data.error;
          }
        } catch (error) {
          status.textContent = 'Chyba při zpracování obrázku';
        }
      }
    };
    </script>
  </div>

  <div class="form-section">
    <h2>Současné obrázky</h2>
    <?php if (!empty($images)): ?>
    <div class="gallery-admin-grid">
      <?php foreach ($images as $img): 
        $imgName = basename($img);
        $imgUrl = '/assets/img/gallery/' . $imgName;
      ?>
      <div class="gallery-admin-item">
        <img src="<?= $imgUrl ?>" alt="<?= htmlspecialchars($imgName) ?>" class="admin-gallery-img">
        <div class="gallery-actions">
          <form action="/actions/delete-gallery-image.php" method="POST" style="display:inline;">
            <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
            <input type="hidden" name="image" value="<?= htmlspecialchars($imgName) ?>">
            <button type="submit" class="btn-delete" onclick="return confirm('Smazat tento obrázek?')">🗑️ Smazat</button>
          </form>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <p class="text-light">Žádné obrázky v galerii.</p>
    <?php endif; ?>
  </div>
</div>

<style>
.gallery-admin-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 20px;
  margin-top: 20px;
}

.gallery-admin-item {
  background: #2a2a2a;
  border-radius: 8px;
  padding: 10px;
  text-align: center;
}

.admin-gallery-img {
  width: 100%;
  height: 150px;
  object-fit: cover;
  border-radius: 4px;
  margin-bottom: 10px;
}

.gallery-actions {
  display: flex;
  justify-content: center;
}

input[type="file"] {
  width: 100%;
  padding: 12px 15px;
  margin-bottom: 15px;
  border-radius: 6px;
  border: 2px solid #333;
  background-color: #1f1f1f;
  color: #fff;
  box-sizing: border-box;
}

.upload-mode-btn {
  padding: 8px 16px;
  border: 2px solid #333;
  background: #1f1f1f;
  color: #fff;
  border-radius: 4px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.upload-mode-btn.active {
  background: #ffc107;
  color: #000;
  border-color: #ffc107;
}

.upload-mode-btn:hover {
  border-color: #555;
}
</style>

<?php include 'admin-footer.php'; ?>