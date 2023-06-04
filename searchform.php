<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
    <div id="custom-search-input">
        <div class="input-group col-md-12">
            <input type="search" class="search-query form-control p-2"
                placeholder="<?php echo esc_attr_x('Search for your favorite set...', 'placeholder') ?>"
                value="<?php echo get_search_query() ?>" name="s"
                title="<?php echo esc_attr_x('Search for:', 'label') ?>" />
            <span class="input-group-btn">
                <button class="btn-primary p-2" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </span>
        </div>
    </div>
</form>