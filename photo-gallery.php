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
      ],
      [
          'id'     => 'coffee-adda',
          'title'  => 'ITLC Coffee Adda (02-12-2024)',
          'folder' => 'Coffee_adda',
          'badge'  => '02-12-2024',
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
          'images' => $images,
          'count'  => count($images)
      ];
  }
?>

<style>
    .itlc-about {
        padding: 170px 0 60px;
        color: #06487a;
    }

    .itlc-about h1 {
        color: #ffbc3b;
    }

    .itlc-about h2,
    .itlc-about h3,
    .itlc-about h4,
    .itlc-about p,
    .itlc-about li,
    .itlc-about strong {
        color: #06487a;
    }

    /* Main Title */
    .itlc-about .main-title {
        font-size: 25px;
        font-weight: 700;
        line-height: 1.4;
        margin: 0 0 12px;
    }

    /* Title Underline */
    .itlc-about .title-accent {
        width: 45px;
        height: 3px;
        background: #06487a;
        border-radius: 2px;
        margin-bottom: 25px;
    }

    /* Premium Album Card */
    .album-card {
        background: #ffffff;
        border-radius: 10px;
        border: 1px solid #eef2f6;
        padding: 14px;
        box-shadow: 0 4px 18px rgba(6, 72, 122, 0.08);
        transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .album-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(6, 72, 122, 0.16);
        border-color: #dbe4ee;
    }

    /* Collage Containers */
    .album-collage-wrap {
        border-radius: 8px;
        overflow: hidden;
        background: #f1f4f8;
        position: relative;
    }

    /* 4 or more photos: 2x2 grid */
    .collage-grid-4 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(2, 1fr);
        gap: 6px;
        height: 290px;
    }

    /* 3 photos grid */
    .collage-grid-3 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(2, 1fr);
        gap: 6px;
        height: 290px;
    }
    .collage-grid-3 .collage-item:first-child {
        grid-row: span 2;
    }

    /* 2 photos grid */
    .collage-grid-2 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 6px;
        height: 290px;
    }

    /* 1 photo */
    .collage-grid-1 {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0;
        height: 290px;
    }

    /* Individual Tile */
    .collage-item {
        position: relative;
        overflow: hidden;
        background: #eef2f6;
        display: block;
        height: 100%;
        width: 100%;
        cursor: pointer;
        text-decoration: none !important;
    }

    .collage-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }

    .collage-item:hover img {
        transform: scale(1.08);
    }

    /* Hover Zoom Overlay */
    .collage-item .item-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(6, 72, 122, 0.45);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .collage-item:hover .item-overlay {
        opacity: 1;
    }

    .collage-item .item-overlay i {
        color: #06487a;
        background: #ffbc3b;
        font-size: 16px;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.25);
    }

    /* +More Photos Overlay */
    .collage-more-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(6, 72, 122, 0.8);
        color: #ffffff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 22px;
        transition: background 0.3s ease;
        pointer-events: none;
    }

    .collage-item:hover .collage-more-overlay {
        background: rgba(6, 72, 122, 0.9);
    }

    .collage-more-overlay span {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #ffbc3b;
        margin-top: 2px;
    }

    /* Album Card Content */
    .album-card-top {
        padding: 4px 4px 12px;
        display: flex;
        flex-direction: column;
    }

    .album-card-title {
        font-size: 18px;
        font-weight: 700;
        color: #06487a;
        font-family: "Trebuchet MS", sans-serif;
        line-height: 1.35;
        margin-bottom: 0;
        transition: color 0.2s ease;
    }

    .album-card:hover .album-card-title,
    .album-card-title:hover {
        color: #ffbc3b;
    }

    .album-card-bottom {
        padding: 12px 4px 4px;
        margin-top: auto;
    }

    .album-meta-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13px;
        color: #666;
    }

    .album-meta-badge {
        background: rgba(6, 72, 122, 0.08);
        color: #06487a;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 12px;
    }

    .album-view-link {
        color: #06487a;
        font-weight: 600;
        font-size: 13px;
        transition: color 0.2s ease;
        text-decoration: none !important;
        cursor: pointer;
    }

    .album-view-link:hover {
        color: #ffbc3b;
    }

    /* ===================================================
       FULLSCREEN LIGHTBOX MODAL (ZERO DEPENDENCY / FAILSAFE)
       =================================================== */
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
        background: rgba(4, 30, 52, 0.94);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
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
        border-radius: 6px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6);
        transition: opacity 0.2s ease;
        user-select: none;
    }

    .itlc-lightbox-btn {
        position: fixed;
        background: rgba(6, 72, 122, 0.85);
        color: #ffffff;
        border: 2px solid rgba(255, 255, 255, 0.35);
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
        background: #ffbc3b;
        color: #06487a;
        border-color: #ffbc3b;
    }

    .itlc-lightbox-close {
        top: 25px;
        right: 30px;
        width: 44px;
        height: 44px;
        font-size: 28px;
        line-height: 1;
    }

    .itlc-lightbox-close:hover {
        transform: rotate(90deg);
    }

    .itlc-lightbox-prev {
        left: 25px;
        top: 50%;
        transform: translateY(-50%);
        width: 52px;
        height: 52px;
        font-size: 22px;
    }

    .itlc-lightbox-prev:hover {
        transform: translateY(-50%) scale(1.08);
    }

    .itlc-lightbox-next {
        right: 25px;
        top: 50%;
        transform: translateY(-50%);
        width: 52px;
        height: 52px;
        font-size: 22px;
    }

    .itlc-lightbox-next:hover {
        transform: translateY(-50%) scale(1.08);
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
        font-family: "Trebuchet MS", sans-serif;
        margin-bottom: 3px;
    }

    .itlc-lightbox-counter {
        font-size: 13px;
        color: #ffbc3b;
        font-weight: 600;
    }

    @media (max-width: 767px) {
        .itlc-about {
            padding: 120px 0 40px;
        }

        .itlc-about .main-title {
            font-size: 25px;
        }

        .collage-grid-4,
        .collage-grid-3,
        .collage-grid-2,
        .collage-grid-1 {
            height: 230px;
        }

        .album-card-title {
            font-size: 16px;
        }

        .itlc-lightbox-btn {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }

        .itlc-lightbox-close {
            top: 15px;
            right: 15px;
            width: 38px;
            height: 38px;
            font-size: 24px;
        }

        .itlc-lightbox-prev {
            left: 10px;
        }

        .itlc-lightbox-next {
            right: 10px;
        }

        .itlc-lightbox-img {
            max-height: 70vh;
            max-width: 95vw;
        }
    }
</style>

<section class="itlc-about">
  <div class="container">

    <!-- Page Header -->
    <div class="row">
      <div class="col-12">
        <h1 class="main-title">Photo Gallery</h1>
        <div class="title-accent"></div>
        <p class="mb-5">
          Explore photographic memories, knowledge sessions, conferences, and collaborative meetups of the IT Leadership Community (ITLC).
        </p>
      </div>
    </div>

    <!-- Albums Grid (Side-by-Side Cards) -->
    <div class="row mb-0">
      <?php foreach ($galleries as $gallery): ?>
        <?php 
          $g_info = $galleries_data[$gallery['id']];
          $images = $g_info['images'];
          $total_photos = $g_info['count'];
          
          // Determine collage grid class based on photo count
          if ($total_photos >= 4) {
              $grid_class = 'collage-grid-4';
              $visible_count = 4;
          } elseif ($total_photos === 3) {
              $grid_class = 'collage-grid-3';
              $visible_count = 3;
          } elseif ($total_photos === 2) {
              $grid_class = 'collage-grid-2';
              $visible_count = 2;
          } else {
              $grid_class = 'collage-grid-1';
              $visible_count = 1;
          }
        ?>

        <div class="col-lg-6 col-md-6 mb-4">
          <div class="album-card">

            <!-- Card Top: Title Only -->
            <div class="album-card-top">
              <a href="#" 
                 class="text-decoration-none" 
                 onclick="openItlcGallery('<?php echo htmlspecialchars($gallery['id']); ?>', 0); return false;">
                <h3 class="album-card-title"><?php echo htmlspecialchars($gallery['title']); ?></h3>
              </a>
            </div>

            <!-- Collage Image Wrap -->
            <div class="album-collage-wrap <?php echo $grid_class; ?>">
              <?php for ($i = 0; $i < $visible_count && $i < $total_photos; $i++): ?>
                <?php 
                  $is_last_visible = ($i === 3 && $total_photos > 4);
                  $extra_count = $total_photos - 4;
                ?>
                <a href="<?php echo htmlspecialchars($images[$i]); ?>" 
                   class="collage-item" 
                   onclick="openItlcGallery('<?php echo htmlspecialchars($gallery['id']); ?>', <?php echo $i; ?>); return false;">
                  <img src="<?php echo htmlspecialchars($images[$i]); ?>" alt="<?php echo htmlspecialchars($gallery['title']); ?>">
                  
                  <?php if ($is_last_visible): ?>
                    <!-- Extra Photos Badge on 4th slot -->
                    <div class="collage-more-overlay">
                      +<?php echo $extra_count; ?>
                      <span>More</span>
                    </div>
                  <?php else: ?>
                    <!-- Hover Zoom Icon -->
                    <div class="item-overlay">
                      <i class="ti-zoom-in"></i>
                    </div>
                  <?php endif; ?>
                </a>
              <?php endfor; ?>
            </div>

            <!-- Card Bottom: Date & Photo Count -->
            <div class="album-card-bottom">
              <div class="album-meta-row">
                <span class="album-meta-badge">
                  <i class="ti-calendar text-primary mr-1"></i><?php echo htmlspecialchars($gallery['badge']); ?>
                </span>
                <a href="#" 
                   class="album-view-link" 
                   onclick="openItlcGallery('<?php echo htmlspecialchars($gallery['id']); ?>', 0); return false;">
                  <i class="ti-image text-primary mr-1"></i><?php echo $total_photos; ?> Photos &bull; View <i class="ti-arrow-right small"></i>
                </a>
              </div>
            </div>

          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
<!-- /itlc-about -->

<!-- Fullscreen Lightbox Modal -->
<div id="itlcLightbox" class="itlc-lightbox">
  <div class="itlc-lightbox-backdrop" onclick="closeItlcGallery()"></div>
  <div class="itlc-lightbox-wrapper">
    <button type="button" class="itlc-lightbox-btn itlc-lightbox-close" onclick="closeItlcGallery()" title="Close (Esc)">&times;</button>
    <button type="button" class="itlc-lightbox-btn itlc-lightbox-prev" onclick="prevItlcGallery()" title="Previous (Left Arrow)"><i class="ti-angle-left"></i></button>
    <button type="button" class="itlc-lightbox-btn itlc-lightbox-next" onclick="nextItlcGallery()" title="Next (Right Arrow)"><i class="ti-angle-right"></i></button>
    
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
