<?php

namespace Inc\Filter;

class HmuAllTaxonomies
{

    /*
     * get terms
     */
    public static function hmu_get_term_option()
    {
        $option_terms = array();
        if(  get_option('hmu_woo_filter') ) {

            $option_terms = get_option('hmu_woo_filter');
           // var_dump(get_option('hmu_woo_filter'));
        }

        return $option_terms;


    }



    /*
     * hmu filter output html
     */
    function hmu_taxonomy_option_to_html()
    {
        $taxonomies = $this->hmu_get_term_option();
        if(!empty($taxonomies)):
        ?>
        <div class="block--shop_filter container">
            <div class="block--shop_filter_attributes row" id="">

                <?php
                // Get product attributes

                foreach ($taxonomies as $key=>$taxonomy):
                    echo '<div class="col-md-12"><h2 class="text-left">'.$key.'</h2></div>';
                foreach ($taxonomy as $child=>$tax):
                    ?>
                    <div class="hmu-container">
                    <div class="hmu-row">
                        <label class="hmucol-md-10 hmucol-sm-10 text-left" for=""><?php echo $child; ?></label>
                        <input
                            type="checkbox"
                            value="<?php ?>"
                            data-term-tax="<?php echo $key  ?>"
                            data-term-slug="<?php echo $child; ?>"
                            data-term="<?php echo $child; ?>"
                            class="hmucol-md-4 hmucol-sm-2 hmu_filter_attributes"

                            <?php echo $taxonomy == '1' ? 'checked' : '' ?>
                        />
                    </div>
                    </div>


                <?php
                endforeach;

                endforeach;



                ?>
            </div>
        </div>
        <?php
        else:
            echo '<p>No category has been selected, please refer to settings page <a href="'.esc_attr(admin_url("admin.php?page=hmu_plugin")).'">here</a></p>';
            endif;

    }
}


