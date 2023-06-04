<footer>
  <?php
  if (
    !is_active_sidebar('legotheme-first-footer-widget')
    && !is_active_sidebar('legotheme-second-footer-widget')
    && !is_active_sidebar('legotheme-third-footer-widget')
    && !is_active_sidebar('legotheme-fourth-footer-widget')
  ) {
  } else { ?>
    <div class="legofooter">
      <div class="container">
        <div class="row">
          <aside class="legotheme-footer row row-cols-1 row-cols-md-2 row-cols-lg-4">
            <?php if (is_active_sidebar('legotheme-first-footer-widget')) { ?>
              <div>
                <?php dynamic_sidebar('legotheme-first-footer-widget'); ?>
              </div>
            <?php } ?>
            <?php if (is_active_sidebar('legotheme-second-footer-widget')) { ?>
              <div>
                <?php dynamic_sidebar('legotheme-second-footer-widget'); ?>
              </div>
            <?php } ?>
            <?php if (is_active_sidebar('legotheme-third-footer-widget')) { ?>
              <div>
                <?php dynamic_sidebar('legotheme-third-footer-widget'); ?>
              </div>
            <?php } ?>
            <?php if (is_active_sidebar('legotheme-fourth-footer-widget')) { ?>
              <div>
                <?php dynamic_sidebar('legotheme-fourth-footer-widget'); ?>
              </div>
            <?php } ?>
          </aside><!-- #legotheme-footer -->
        </div>
      </div>
    </div>
  <?php } ?>
  <div class="copyright text-center">
    <p>Copyright &copy;  2023 | Just One Brick | Developed by Cameron Morgan | All rights reserved</p>
  </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>