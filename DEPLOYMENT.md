# Deployment Structure

This project is now organized so shared frontend parts can be reused more easily when deploying:

- `index.php`: homepage
- `portfolio.php`: portfolio page
- `includes/site-head.php`: shared head/meta/CSS includes
- `includes/site-header.php`: shared header and navigation
- `includes/mobile-cta.php`: mobile bottom action bar
- `includes/consultation-modal.php`: shared consultation modal
- `includes/site-footer.php`: shared footer
- `includes/site-scripts.php`: shared frontend scripts
- `asset/`: public CSS, JS, plugins, and images
- `admin/`: admin panel and uploaded images

For server deploy:

1. Upload the whole project root.
2. Make sure PHP is enabled.
3. Import the database used by `dbconnection.php`.
4. Update `dbconnection.php` with your live server database credentials.
5. Keep write permission available for folders used by admin image uploads if your hosting requires it.
