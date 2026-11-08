<?php 
  $page_title = "Photo Gallery - IT Leadership Community";
  $current_page = "photo-gallery";

  // Include configuration
  include 'includes/config.php';
  include 'includes/header.php';

  // Albums configuration
  $galleries = [
      [
          'id'     => 'knowledge-exchange',
          'title'  => 'Knowledge exchange & Networking Session',
          'folder' => 'Knowledge_exchange',
          'badge'  => '15-09-2025',
          'venue'  => 'Dhaka, Bangladesh',
      ],
      [
          'id'     => 'coffee-adda',
          'title'  => 'ITLC Coffee Adda (02-12-2024)',
          'folder' => 'Coffee_adda',
          'badge'  => '02-12-2024',
          'venue'  => 'Executive Lounge, Dhaka',
      ],
  ];

  // Scan album images dynamically and prepare JSON data for the lightbox
  $galleries_data = [];
  foreach ($galleries as $g) {
      $folder_path = __DIR__ . '/images/photo_gallery/' . $g['folder'];
      $images = [];
      if (is_dir($folder_path)) {
          $found = glob($folder_path . '/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE);
          if ($found) {
              foreach ($found as $f) {
                  $images[] = 'images/photo_gallery/' . $g['folder'] . '/' . basename($f);
              }
          }
      }
      // Fallback if folder empty or glob disabled
      if (empty($images)) {
          for ($i = 1; $i <= 4; $i++) {
              $images[] = 'images/photo_gallery/' . $g['folder'] . '/' . $i . '.jpg';
          }
      }
      $galleries_data[$g['id']] = [
          'id'     => $g['id'],
          'title'  => $g['title'],
          'badge'  => $g['badge'],
          'venue'  => $g['venue'],
          'images' => $images,
          'count'  => count($images)
      ];
  }
?>

<style>
/* Modern 2026 Photo Gallery System */
.itlc-album-card {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid rgba(6, 72, 122, 0.08);
    padding: 16px;
    box-shadow: 0 10px 30px rgba(6, 72, 122, 0.05);
    transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
    display: flex;
    flex-direction: column;
    height: 100%;
}

.itlc-album-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(6, 72, 122, 0.14);
    border-color: rgba(6, 72, 122, 0.18);
}

.itlc-album-card-top {
    padding: 6px 6px 14px;
}

.itlc-album-card-title {
    font-size: 19px;
    font-weight: 700;
    color: #06487a;
    line-height: 1.35;
    margin-bottom: 0;
    transition: color 0.2s ease;
}

.itlc-album-card:hover .itlc-album-card-title,
.itlc-album-card-title:hover {
    color: #f59e0b;
}

/* Collage Containers */
.itlc-album-collage-wrap {
    border-radius: 10px;
    overflow: hidden;
    background: #03233e;
    position: relative;
}

/* 4 or more photos: 2x2 grid */
.itlc-grid-4 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(2, 1fr);
    gap: 6px;
    height: 310px;
}

/* 3 photos grid */
.itlc-grid-3 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(2, 1fr);
    gap: 6px;
    height: 310px;
}
.itlc-grid-3 .itlc-collage-item:first-child {
    grid-row: span 2;
}

/* 2 photos grid */
.itlc-grid-2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 6px;
    height: 310px;
}

/* 1 photo */
.itlc-grid-1 {
    display: grid;
    grid-template-columns: 1fr;
    gap: 0;
    height: 310px;
}

/* Individual Tile */
.itlc-collage-item {
    position: relative;
    overflow: hidden;
    background: #0f172a;
    display: block;
    height: 100%;
    width: 100%;
    cursor: pointer;
    text-decoration: none !important;
}

.itlc-collage-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.itlc-collage-item:hover img {
    transform: scale(1.08);
}

/* Hover Zoom Overlay */
.itlc-collage-item .item-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(3, 35, 62, 0.5);
    backdrop-filter: blur(2px);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.itlc-collage-item:hover .item-overlay {
    opacity: 1;
}

.itlc-collage-item .item-overlay i {
    color: #03233e;
    background: #f59e0b;
    font-size: 16px;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 14px rgba(0,0,0,0.3);
    transition: transform 0.25s ease;
}

.itlc-collage-item:hover .item-overlay i {
    transform: scale(1.1);
}

/* +More Photos Overlay */
.itlc-collage-more-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(3, 35, 62, 0.85);
    backdrop-filter: blur(4px);
    color: #ffffff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 24px;
    transition: background 0.3s ease;
    pointer-events: none;
}

.itlc-collage-item:hover .itlc-collage-more-overlay {
    background: rgba(3, 35, 62, 0.92);
}

.itlc-collage-more-overlay span {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #f59e0b;
    font-weight: 700;
    margin-top: 2px;
}

/* Card Bottom */
.itlc-album-card-bottom {
    padding: 14px 6px 4px;
    margin-top: auto;
}

.itlc-album-meta-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 13px;
    color: #64748b;
}

.itlc-album-meta-badge {
    background: rgba(6, 72, 122, 0.08);
    color: #06487a;
    font-weight: 600;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
}

.itlc-album-meta-badge i {
    color: #f59e0b;
    margin-right: 6px;
}

.itlc-album-view-link {
    color: #06487a;
    font-weight: 700;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.2s ease;
    text-decoration: none !important;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
}

.itlc-album-view-link i {
    margin-left: 6px;
    transition: transform 0.2s ease;
}

.itlc-album-card:hover .itlc-album-view-link {
    color: #f59e0b;
}

.itlc-album-card:hover .itlc-album-view-link i {
    transform: translateX(4px);
}

/* Fullscreen Lightbox Modal */
.itlc-lightbox {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999999;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.25s ease, visibility 0.25s ease;
}

.itlc-lightbox.active {
    opacity: 1;
    visibility: visible;
}

.itlc-lightbox-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(2, 20, 36, 0.95);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

.itlc-lightbox-wrapper {
    position: relative;
    z-index: 2;
    max-width: 92vw;
    max-height: 92vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.itlc-lightbox-stage {
    display: flex;
    align-items: center;
    justify-content: center;
    max-width: 100%;
    max-height: 80vh;
}

.itlc-lightbox-img {
    max-width: 90vw;
    max-height: 78vh;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 12px 50px rgba(0, 0, 0, 0.7);
    transition: opacity 0.2s ease;
    user-select: none;
}

.itlc-lightbox-btn {
    position: fixed;
    background: rgba(3, 35, 62, 0.85);
    backdrop-filter: blur(6px);
    color: #ffffff;
    border: 1.5px solid rgba(255, 255, 255, 0.25);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    z-index: 10;
    outline: none;
}

.itlc-lightbox-btn:hover {
    background: #f59e0b;
    color: #03233e;
    border-color: #f59e0b;
    transform: scale(1.1);
}

.itlc-lightbox-close {
    top: 25px;
    right: 30px;
    width: 46px;
    height: 46px;
    font-size: 20px;
}

.itlc-lightbox-prev {
    left: 25px;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    font-size: 18px;
}

.itlc-lightbox-prev:hover {
    transform: translateY(-50%) scale(1.1);
}

.itlc-lightbox-next {
    right: 25px;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    font-size: 18px;
}

.itlc-lightbox-next:hover {
    transform: translateY(-50%) scale(1.1);
}

.itlc-lightbox-footer {
    margin-top: 14px;
    text-align: center;
    color: #ffffff;
    z-index: 2;
}

.itlc-lightbox-album-title {
    font-size: 16px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 3px;
}

.itlc-lightbox-counter {
    font-size: 13px;
    color: #f59e0b;
    font-weight: 700;
}

@media (max-width: 767px) {
    .itlc-grid-4,
    .itlc-grid-3,
    .itlc-grid-2,
    .itlc-grid-1 {
        height: 240px;
    }

    .itlc-album-card-title {
        font-size: 16.5px;
    }

    .itlc-lightbox-close {
        top: 15px;
        right: 15px;
        width: 38px;
        height: 38px;
        font-size: 16px;
    }

    .itlc-lightbox-prev {
        left: 10px;
        width: 40px;
        height: 40px;
    }

    .itlc-lightbox-next {
        right: 10px;
        width: 40px;
        height: 40px;
    }

    .itlc-lightbox-img {
        max-height: 70vh;
        max-width: 95vw;
    }
}
</style>

<!-- Modern Page Hero -->
<section class="itlc-page-hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <div class="itlc-hero-badge"><i class="fa-solid fa-images mr-1"></i> Visual Highlights</div>
        <h1 class="itlc-hero-title">Moments & <span>Photo Gallery</span></h1>
        <p class="itlc-hero-desc">Explore photographic memories, knowledge sessions, conferences, and collaborative meetups of the IT Leadership Community (ITLC).</p>
      </div>
      <div class="col-lg-4 text-lg-right mt-3 mt-lg-0">
        <a href="events.php" class="btn btn-gold-sm px-4 py-2 font-weight-bold">
          <i class="fa-solid fa-calendar-days mr-2"></i> Upcoming Events
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Photo Gallery Section -->
<section class="itlc-content-section" style="background: #f8fafc; padding: 50px 0 80px;">
  <div class="container">

    <!-- Albums Grid (Side-by-Side Cards) -->
    <div class="row">
      <?php foreach ($galleries as $gallery): ?>
        <?php 
          $g_info = $galleries_data[$gallery['id']];
          $images = $g_info['images'];
          $total_photos = $g_info['count'];
          
          // Determine collage grid class based on photo count
          if ($total_photos >= 4) {
              $grid_class = 'itlc-grid-4';
              $visible_count = 4;
          } elseif ($total_photos === 3) {
              $grid_class = 'itlc-grid-3';
              $visible_count = 3;
          } elseif ($total_photos === 2) {
              $grid_class = 'itlc-grid-2';
              $visible_count = 2;
          } else {
              $grid_class = 'itlc-grid-1';
              $visible_count = 1;
          }
        ?>

        <div class="col-lg-6 col-md-6 mb-4">
          <div class="itlc-album-card">

            <!-- Card Top: Title Only -->
            <div class="itlc-album-card-top">
              <a href="#" 
                 class="text-decoration-none" 
                 onclick="openItlcGallery('<?php echo htmlspecialchars($gallery['id']); ?>', 0); return false;">
                <h3 class="itlc-album-card-title"><?php echo htmlspecialchars($gallery['title']); ?></h3>
              </a>
            </div>

            <!-- Collage Image Wrap -->
            <div class="itlc-album-collage-wrap <?php echo $grid_class; ?>">
              <?php for ($i = 0; $i < $visible_count && $i < $total_photos; $i++): ?>
                <?php 
                  $is_last_visible = ($i === 3 && $total_photos > 4);
                  $extra_count = $total_photos - 4;
                ?>
                <a href="<?php echo htmlspecialchars($images[$i]); ?>" 
                   class="itlc-collage-item" 
                   onclick="openItlcGallery('<?php echo htmlspecialchars($gallery['id']); ?>', <?php echo $i; ?>); return false;">
                  <img src="<?php echo htmlspecialchars($images[$i]); ?>" alt="<?php echo htmlspecialchars($gallery['title']); ?>" loading="lazy">
                  
                  <?php if ($is_last_visible): ?>
                    <!-- Extra Photos Badge on 4th slot -->
                    <div class="itlc-collage-more-overlay">
                      +<?php echo $extra_count; ?>
                      <span>More Photos</span>
                    </div>
                  <?php else: ?>
                    <!-- Hover Zoom Icon -->
                    <div class="item-overlay">
                      <i class="fa-solid fa-magnifying-glass-plus"></i>
                    </div>
                  <?php endif; ?>
                </a>
              <?php endfor; ?>
            </div>

            <!-- Card Bottom: Date & Photo Count -->
            <div class="itlc-album-card-bottom">
              <div class="itlc-album-meta-row">
                <span class="itlc-album-meta-badge">
                  <i class="fa-solid fa-calendar-day"></i><?php echo htmlspecialchars($gallery['badge']); ?>
                </span>
                <a href="#" 
                   class="itlc-album-view-link" 
                   onclick="openItlcGallery('<?php echo htmlspecialchars($gallery['id']); ?>', 0); return false;">
                  <span><i class="fa-solid fa-images mr-1"></i> <?php echo $total_photos; ?> Photos &bull; View Album</span>
                  <i class="fa-solid fa-arrow-right"></i>
                </a>
              </div>
            </div>

          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Community Photo Contribution Banner -->
    <div class="mt-5 p-4 p-md-5 rounded-lg text-white d-flex flex-column flex-md-row align-items-center justify-content-between" 
         style="background: linear-gradient(135deg, #06487a 0%, #03233e 100%); border-radius: 14px; box-shadow: 0 10px 30px rgba(6, 72, 122, 0.15);">
      <div class="mb-3 mb-md-0 text-center text-md-left">
        <h3 class="font-weight-bold text-white mb-2" style="font-size: 22px;">Have Event Photographs to Share?</h3>
        <p class="mb-0 text-white-50" style="font-size: 14px; max-width: 600px;">
          Did you attend an ITLC conference, roundtable, or meet? Share your high-resolution photos with our media communications team.
        </p>
      </div>
      <div>
        <a href="contact.php" class="btn btn-gold-sm px-4 py-2 font-weight-bold text-nowrap">
          <i class="fa-solid fa-paper-plane mr-2"></i> Submit Photos
        </a>
      </div>
    </div>

  </div>
</section>

<!-- Fullscreen Lightbox Modal -->
<div id="itlcLightbox" class="itlc-lightbox">
  <div class="itlc-lightbox-backdrop" onclick="closeItlcGallery()"></div>
  <div class="itlc-lightbox-wrapper">
    <button type="button" class="itlc-lightbox-btn itlc-lightbox-close" onclick="closeItlcGallery()" title="Close (Esc)"><i class="fa-solid fa-xmark"></i></button>
    <button type="button" class="itlc-lightbox-btn itlc-lightbox-prev" onclick="prevItlcGallery()" title="Previous (Left Arrow)"><i class="fa-solid fa-chevron-left"></i></button>
    <button type="button" class="itlc-lightbox-btn itlc-lightbox-next" onclick="nextItlcGallery()" title="Next (Right Arrow)"><i class="fa-solid fa-chevron-right"></i></button>
    
    <div class="itlc-lightbox-stage">
      <img id="itlcLightboxImg" src="" alt="Photo Preview" class="itlc-lightbox-img" onclick="nextItlcGallery()">
    </div>

    <div class="itlc-lightbox-footer">
      <div id="itlcLightboxTitle" class="itlc-lightbox-album-title"></div>
      <div id="itlcLightboxCounter" class="itlc-lightbox-counter"></div>
    </div>
  </div>
</div>

<script>
// JSON data of all album photos
const itlcGalleries = <?php echo json_encode($galleries_data); ?>;
let currentAlbumId = null;
let currentImgIndex = 0;

function openItlcGallery(albumId, index) {
    if (!itlcGalleries[albumId] || !itlcGalleries[albumId].images || !itlcGalleries[albumId].images.length) {
        return;
    }
    currentAlbumId = albumId;
    currentImgIndex = parseInt(index, 10) || 0;
    
    updateLightboxContent();
    
    const modal = document.getElementById('itlcLightbox');
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeItlcGallery() {
    const modal = document.getElementById('itlcLightbox');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

function prevItlcGallery() {
    if (!currentAlbumId || !itlcGalleries[currentAlbumId]) return;
    const count = itlcGalleries[currentAlbumId].images.length;
    currentImgIndex = (currentImgIndex - 1 + count) % count;
    updateLightboxContent();
}

function nextItlcGallery() {
    if (!currentAlbumId || !itlcGalleries[currentAlbumId]) return;
    const count = itlcGalleries[currentAlbumId].images.length;
    currentImgIndex = (currentImgIndex + 1) % count;
    updateLightboxContent();
}

function updateLightboxContent() {
    if (!currentAlbumId || !itlcGalleries[currentAlbumId]) return;
    const album = itlcGalleries[currentAlbumId];
    const img = document.getElementById('itlcLightboxImg');
    const title = document.getElementById('itlcLightboxTitle');
    const counter = document.getElementById('itlcLightboxCounter');
    
    if (img) {
        img.style.opacity = '0.3';
        img.src = album.images[currentImgIndex];
        img.onload = function() {
            img.style.opacity = '1';
        };
    }
    if (title) {
        title.textContent = album.title;
    }
    if (counter) {
        counter.textContent = 'Photo ' + (currentImgIndex + 1) + ' of ' + album.images.length;
    }
}

// Keyboard navigation (Escape, Left, Right)
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('itlcLightbox');
    if (!modal || !modal.classList.contains('active')) return;
    if (e.key === 'Escape') closeItlcGallery();
    if (e.key === 'ArrowLeft') prevItlcGallery();
    if (e.key === 'ArrowRight') nextItlcGallery();
});
</script>

<?php 
include 'includes/footer.php'; 
?>
