<?php $showFloatingContact = $showFloatingContact ?? false; ?>
<?php if ($showFloatingContact): ?>
<div class="floating-contact desktop-only">
  <div class="chat-options" id="chatOptions">
    <a href="tel:+918902277660" class="chat-icon call"><i class="fas fa-phone-alt"></i></a>
    <a href="https://wa.me/918902277660" target="_blank" rel="noopener noreferrer" class="chat-icon whatsapp"><i class="fab fa-whatsapp"></i></a>
  </div>
  <div class="chat-main" onclick="toggleChat()">
    <i id="toggleIcon" class="fas fa-comment-alt"></i>
  </div>
</div>
<?php endif; ?>

<script src="asset/plugins/jquery/jquery.min.js"></script>
<script src="asset/plugins/bootstrap/bootstrap.min.js"></script>
<script src="asset/plugins/parallax/jquery.parallax-1.1.3.js"></script>
<script src="asset/plugins/lightbox2/js/lightbox.min.js"></script>
<script src="asset/plugins/slick/slick.min.js"></script>
<script src="asset/plugins/filterizr/jquery.filterizr.min.js"></script>
<script src="asset/plugins/smooth-scroll/smooth-scroll.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU"></script>
<script src="asset/plugins/google-map/gmap.js"></script>
<script src="asset/js/script.js"></script>
<?php if ($showFloatingContact): ?>
<script>
  function toggleChat() {
    const options = document.getElementById("chatOptions");
    const icon = document.getElementById("toggleIcon");

    options.classList.toggle("show");
    icon.className = options.classList.contains("show") ? "fas fa-times" : "fas fa-comment-alt";
  }
</script>
<?php endif; ?>
<?php if (!empty($extraScripts)) { echo $extraScripts; } ?>
</body>
</html>
