<?php
/**
 * Custom Font Control for the Customizer
 *
 * @package Poseidon Pro
 */

/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Displays a custom Font control. Allows to switch fonts for particular elements on the theme.
	 */
	class Poseidon_Pro_Customize_Font_Control extends WP_Customize_Control {

		/**
		 * Declare the control type. Critical for JS constructor.
		 *
		 * @var string
		 */
		public $type = 'poseidon_pro_custom_font';

		/**
		 * Localization Strings.
		 *
		 * @var array
		 */
		public $l10n = array();

		/**
		 * Custom Fonts Array
		 *
		 * @var array
		 */
		private $fonts = false;

		/**
		 * Setup Font Control
		 *
		 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
		 * @param String               $id      Control ID.
		 * @param array                $args    Arguments to override class property defaults.
		 * @return void
		 */
		public function __construct( $manager, $id, $args = array() ) {

			// Make Buttons translateable.
			$this->l10n = array(
				'previous' => esc_html__( 'Previous Font', 'poseidon-pro' ),
				'next'     => esc_html__( 'Next Font', 'poseidon-pro' ),
				'standard' => esc_html_x( 'Default', 'default font button', 'poseidon-pro' ),
			);

			// Set Fonts.
			$this->fonts = Poseidon_Pro_Custom_Fonts::get_available_fonts();

			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Enqueue Font Control JS
		 *
		 * @return void
		 */
		public function enqueue() {
			// Register and Enqueue Custom Font JS Constructor.
			wp_enqueue_script( 'poseidon-pro-custom-font-control', POSEIDON_PRO_PLUGIN_URL . 'assets/js/custom-font-control.min.js', array( 'customize-controls' ), '20210212', true );
		}

		/**
		 * Display Control
		 *
		 * @return void
		 */
		public function render_content() {
			$l10n = json_encode( $this->l10n );

			if ( ! empty( $this->fonts ) ) : ?>

				<label>
					<span class="customize-control-title" data-l10n="<?php echo esc_attr( $l10n ); ?>" data-font="<?php echo esc_attr( $this->setting->default ); ?>">
						<?php echo esc_html( $this->label ); ?>
					</span>
					<div class="customize-font-select-control">
						<select <?php $this->link(); ?>>
							<?php
							foreach ( $this->fonts as $k => $v ) :
								printf( '<option value="%s" %s>%s</option>', $k, selected( $this->value(), $k, false ), $v );
							endforeach;
							?>
						</select>
					</div>
					<div class="actions"></div>
				</label>

				<?php
			endif;
		}
	}

endif;
