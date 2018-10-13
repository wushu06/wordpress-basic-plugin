<?php
use Inc\Base\BaseController;
use Inc\Filter\HmuCategoryFilter;
?>
<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

<h2>Plugin's Panel Control</h2>


<!--<form method="post" class="hmu-general-form" action="options.php">
    <?php
/*    settings_fields( 'hmu_dashboard_options_group' );
    do_settings_sections( 'hmu_plugin' );
    submit_button( 'Save Settings', 'hmu-btn hmu-primary', 'btnSubmit' );
    */?>
</form>-->
<?php

if( isset( $_POST['hmu_woo_filter_meta_nonce'] ) && wp_verify_nonce( $_POST['hmu_woo_filter_meta_nonce'], 'hmu_woo_filter_form_nonce') ) {
    unset($_POST['action'],$_POST['hmu_woo_filter_meta_nonce'], $_POST['submit'] );
    update_option('hmu_woo_filter', $_POST);

}
if(isset($_GET['reset']) && $_GET['reset'] == 'true' ){

    update_option('hmu_woo_filter', array());
    wp_redirect( admin_url( 'admin.php?page=hmu_plugin' ) );
}

if( $option_terms = get_option('hmu_woo_filter')) {


    //var_dump(get_option('hmu_woo_filter'));
}
?>

<div class="block--shop_filter">
    <div class="block--shop_filter_attributes" id="">
        <form action="<?php echo esc_url( admin_url( 'admin.php?page=hmu_plugin' ) ); ?>" method="post" id="nds_add_user_meta_form" >

            <input type="hidden" name="action" value="hmu_form_response">
            <input type="hidden" name="hmu_woo_filter_meta_nonce" value="<?php echo wp_create_nonce( 'hmu_woo_filter_form_nonce' )?>" />
            <?php
                $option_terms = get_option('hmu_woo_filter') ? get_option('hmu_woo_filter') : array() ;
                $taxonomies = get_taxonomies();
                $taxonomy_object_clean = array();
                $taxonomy_objects_all = get_object_taxonomies( 'product', 'names' );
                $taxonomy_objects = array_diff($taxonomy_objects_all, ["product_type", "product_visibility", "product_tag", "product_shipping_class"]);
                foreach ($taxonomy_objects as $taxonomy_object){
                    if (strpos($taxonomy_object, 'pa_') === false) {
                        $taxonomy_object_clean [] = $taxonomy_object ;
                    }

                }
                foreach ( $taxonomy_objects as $tax ) {
                    echo '<h1>'.$tax.'</h1>';


                    $terms = get_terms($tax, 'orderby=count&hide_empty=1');
                    if (!empty($terms) && !is_wp_error($terms)) {
                        foreach ($terms as $term) {


                            ?>
                        <div class="tax-parent">
                            <label class="taxonomy-label" for=""><?php  echo  $term->name; ?></label>
                            <input
                                    id=""
                                    class="taxonomy-checkbox"
                                    data-value=" <?php echo  $term->term_id;  ?> "
                                    type="checkbox"
                                    name="<?php echo  $tax.'['.$this->seoUrl($term->name).']';?>"
                                    <?php foreach ($option_terms as $key=>$option_term){
                                        echo  array_key_exists($this->seoUrl($term->name),$option_term) ? 'value="'.$term->term_id.'"' : '';
                                        echo  array_key_exists($this->seoUrl($term->name),$option_term) ? 'checked' : '';
                                    } ?>
                            />

                            <?php

                            $chilterms = get_terms($tax, array('parent' => $term->term_id, 'orderby' => 'slug', 'hide_empty' => false));
                            if (!empty($chilterms) && !is_wp_error($chilterms)) {
                                foreach ($chilterms as $childterm) {
                                  //  var_dump($childterm);
                                    ?>


                                        <div class="tax-children">
                                            <label class="taxonomy-label" for=""><?php echo $childterm->name; ?></label>
                                            <input
                                                    id=""
                                                    class="taxonomy-checkbox"
                                                    type="checkbox"
                                                    data-value=" <?php echo  $childterm->term_id;  ?> "
                                                    name="<?php echo $this->seoUrl($term->name).'['.$this->seoUrl($childterm->name).']';  ?>"
                                                    <?php foreach ($option_terms as $key=>$option_term){
                                                        echo  array_key_exists($this->seoUrl($childterm->name),$option_term) ? 'value="'.$childterm->name.'"' : '';
                                                        echo  array_key_exists($this->seoUrl($childterm->name),$option_term) ? 'checked' : '';
                                                    } ?>
                                            />
                                        </div>


                                    <?php

                                }
                            } ?>
                        </div>
                            <?php
                        }
                    }
                }?>


            <input type="submit" value="submit" name="submit">
        </form>


    </div>
</div>
    <a class="hmu_delete" href="<?php echo esc_url( admin_url( 'admin.php?page=hmu_plugin&reset=true' ) ); ?>">Reset</a>

<script>
    jQuery(function ($) {
        $('.hmu_delete').on('click', function(e) {

            let r = confirm("Are you sure you want to rest settings?");
            if (r === false ){
                e.preventDefault();
            }
        });
        $('input').on('change', function() {
            var value = $(this).attr('data-value');
            console.log(value)
            if($(this).is(':checked')) {
                $(this).attr('value' , value)
            }else {
                $(this).attr('value' , 0)
            }
            console.log($(this).attr('value'));
        })
    })
</script>
