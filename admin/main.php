<?php
namespace WB_VC_BAIC\Admin;

/**
 * Main Class
 *
 * main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */

class WB_VC_BAIC_Main extends \WPBakeryShortCode{
	
	static $count= 0;

	function __construct() {
		
		add_shortcode('wb_vc_before_after_image_comparison', array( $this, 'before_after_image_comparison') );

		add_action( 'init', array( $this, 'map_element' ) );

		// Register CSS and JS
        add_action( 'wp_enqueue_scripts', array( $this, 'load_css_and_js' ) );
	}


	public function before_after_image_comparison( $atts, $content='' ){
		static::$count++;

		$css = '';
	    // Params extraction
	    $attr = shortcode_atts(
		            array(
		                'before_image' => '',
		                'after_image' => '',
		                'image_size'  => 'thumbnail',
		                'css' => ''
		            ),
		            $atts
		        );

	    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, '' ), '', $atts );

		$id = 'wb_before_after_'.static::$count;
		$image_size = $attr['image_size'];
		ob_start();
?>

		<div class="twentytwenty-container" id="<?php echo esc_attr( $id ); ?>">
			<?php echo wp_get_attachment_image( $attr['before_image'], $image_size ); ?>
			<?php echo wp_get_attachment_image( $attr['after_image'], $image_size ); ?>
		</div>
		
<?php
		wp_add_inline_script('wb-vc-before-after-slider-js', 'jQuery(window).on("load", function(){jQuery("#'. esc_attr($id). '").twentytwenty(); alert(); });');
		return ob_get_clean();
	}

	public function load_css_and_js(){
		wp_enqueue_style( 'wb-vc-before-after-slider', WB_VC_BAIC_URL . 'assets/vendors/twentytwenty/css/twentytwenty.css', array(), '1.0.0', 'all' );

		wp_enqueue_script( 'wb-vc-before-after-slider-event-move', WB_VC_BAIC_URL . 'assets/vendors/twentytwenty/js/jquery.event.move.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'wb-vc-before-after-slider-library', WB_VC_BAIC_URL . 'assets/vendors/twentytwenty/js/jquery.twentytwenty.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'wb-vc-before-after-slider-js', WB_VC_BAIC_URL . 'assets/js/main.js', array( 'jquery' ), '1.0.0', true );
	}

	public function map_element(){
		vc_map(
			array(
			    'name' => __('Before After Image Comparison Slider', 'before-after-image-comparison-slider-for-visual-composer'),
			    'base' => 'wb_vc_before_after_image_comparison',
			    'description' => __('Compare Two Image for your before and after Effects', 'before-after-image-comparison-slider-for-visual-composer'),
			    'category' => __('Web Builders Elements', 'before-after-image-comparison-slider-for-visual-composer'),
			    "content_element" => true,
			    'params' => array(
				    			array(
				                    'type' => 'attach_image',
			                        'holder' => 'img',
			                        'class' => 'wb-before-image',
			                        'heading' => __( 'Before Image', 'before-after-image-comparison-slider-for-visual-composer' ),
			                        'param_name' => 'before_image',
			                        'value' => __( '', 'before-after-image-comparison-slider-for-visual-composer' ),
			                        'description' => __( 'Upload Before Image From Here', 'before-after-image-comparison-slider-for-visual-composer' ),
			                        'admin_label' => false,
			                        'weight' => 0,
			                        'group' => '',
			                    ),
			                    array(
				                    'type' => 'attach_image',
			                        'holder' => 'img',
			                        'class' => 'wb-after-image',
			                        'heading' => __( 'After Image', 'before-after-image-comparison-slider-for-visual-composer' ),
			                        'param_name' => 'after_image',
			                        'value' => __( '', 'before-after-image-comparison-slider-for-visual-composer' ),
			                        'description' => __( 'Upload After Image From Here', 'before-after-image-comparison-slider-for-visual-composer' ),
			                        'admin_label' => false,
			                        'weight' => 0,
			                        'group' => '',
			                    ),
			                    array(
				                    'type' => 'dropdown',
			                        'heading' => __( 'Image Size', 'before-after-image-comparison-slider-for-visual-composer' ),
			                        'param_name' => 'image_size',
			                        'value' => get_intermediate_image_sizes(),
			                        'description' => __( 'Select Image Size from here', 'before-after-image-comparison-slider-for-visual-composer' ),
			                    ),
			                    array(
			                        'type' => 'css_editor',
			                        'heading' => __( 'Css', 'before-after-image-comparison-slider-for-visual-composer' ),
			                        'param_name' => 'css',
			                        'group' => __( 'Design options', 'before-after-image-comparison-slider-for-visual-composer' ),
			                    ),  
				            ),
			));
	}

}


new WB_VC_BAIC_Main();