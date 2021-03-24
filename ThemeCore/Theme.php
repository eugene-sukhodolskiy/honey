<?php

namespace ThemeCore;

use \ThemeCore\Classes\AjaxController;

class Theme{
	public $ajax_controller;

	public function __construct(){
		$this -> setup();
	}

	public function setup(){
		add_action('after_setup_theme', function(){
			add_theme_support('post-thumbnails');
			add_theme_support('widgets');

			register_nav_menus(
				[
					'header-left' => 'Header left side',
					'header-right' => 'Header right side',
					'footer' => 'Footer nav',
					'social' => 'Social links',
					'cats' => 'Block of categories'
				]
			);
		});

		add_action( 'widgets_init', function(){
			register_sidebar( array(
				'name'          => "Footer",
				'id'            => 'footer-sidebar',
				'description'   => 'Footer widgets',
				'class'         => '',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => "</div>\n",
				'before_title'  => '<h2 class="widgettitle" style="display: none">',
				'after_title'   => "</h2>\n",
			) );
		} );

		add_action('admin_menu', function(){
			$this -> render_custom_settings();
		});

		$this -> ajax_controller = new AjaxController();

		add_filter( 'woocommerce_enqueue_styles', '__return_false' );

		add_action('wp_ajax_woocommerce_ajax_add_to_cart', function(){
			$this -> add_to_cart();
		});
		add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', function(){
			$this -> add_to_cart();
		});

		add_action('wp_ajax_woocommerce_ajax_remove_from_cart', function(){
			$this -> remove_from_cart();
		});
		add_action('wp_ajax_nopriv_woocommerce_ajax_remove_from_cart', function(){
			$this -> remove_from_cart();
		});

		add_action('wp_ajax_woocommerce_ajax_get_cart_counter', function(){
			$this -> get_cart_counter();
		});
		add_action('wp_ajax_nopriv_woocommerce_ajax_get_cart_counter', function(){
			$this -> get_cart_counter();
		});

		add_action('wp_ajax_woocommerce_ajax_new_tem_quantity_cart', function(){
			$this -> new_tem_quantity_cart();
		});
		add_action('wp_ajax_nopriv_woocommerce_ajax_new_tem_quantity_cart', function(){
			$this -> new_tem_quantity_cart();
		});

		add_action('wp_ajax_ajax_order', function(){
			$this -> submited_ajax_order_data();
		});
		add_action( 'wp_ajax_nopriv_ajax_order', function(){
			$this -> submited_ajax_order_data();
		});
	}

	public function render_custom_settings(){
		// field 1
		$id = 'insta_account';
		register_setting('general', $id);
		add_settings_field(
			$id, 
			'Instagram account', 
			function($val){
				$current_val = esc_attr(get_option($val['option_name']));
				echo "<input 
					type=\"text\" 
					name=\"{$val['option_name']}\" 
					id=\"{$val['id']}\" 
					value=\"{$current_val}\" 
					placeholder=\"Instagram account\"
				>";
			}, 
			'general', 
			'default', 
			[ 
				'id' => $id, 
				'option_name' => $id 
			]
		);

		// field 2
		$id = 'count_insta_posts';
		register_setting('general', $id);
		add_settings_field(
			$id, 
			'Количество постов Instagram', 
			function($val){
				$current_val = esc_attr(get_option($val['option_name']));
				echo "<input 
					type=\"number\" 
					name=\"{$val['option_name']}\" 
					id=\"{$val['id']}\" 
					value=\"{$current_val}\" 
					max=\"10\"
					min=\"1\"
					step=\"1\"
					placeholder=\"Количество постов Instagram\"
				>";
			}, 
			'general', 
			'default', 
			[ 
				'id' => $id, 
				'option_name' => $id 
			]
		);
	}

	public function add_to_cart(){
		$product_id = intval($_POST['product_id']);
		$quantity = intval($_POST['quantity']);
		\WC() -> cart -> add_to_cart($product_id, $quantity);
		die(true);
	}

	public function remove_from_cart(){
		$item_key = $_POST['item_key'];
		\WC() -> cart -> remove_cart_item($item_key);
		die(true);
	}

	public function get_cart_counter(){
		die(json_encode([
			'counter' => \WC() -> cart -> cart_contents_count
		]));
	}

	public function new_tem_quantity_cart(){
		$product_id = intval($_POST['product_id']);
		$quantity = intval($_POST['quantity']);
		$item_key = $_POST['item_key'];
		\WC() -> cart -> set_quantity($item_key, $quantity, true);

		die(true);
	}

	public function submited_ajax_order_data() {
		if( isset($_POST['fields']) && ! empty($_POST['fields']) ) {

			$order = new \WC_Order();
			$cart = \WC() -> cart;
			$checkout = \WC() -> checkout;
			$data = [];

			// Loop through posted data array transmitted via jQuery
			foreach( $_POST['fields'] as $values ){
				// Set each key / value pairs in an array
				$data[$values['name']] = $values['value'];
			}

			list($data['billing_first_name'], $data['billing_last_name']) = explode(' ', $data['name']);
			$data['shipping_first_name'] = $data['billing_first_name'];
			$data['shipping_last_name'] = $data['billing_last_name'];
			$data['shipping_phone'] = $data['billing_phone'];
			$data['shipping_email'] = $data['billing_email'];
			$data['shipping_state'] = $data['billing_state'];
			$data['shipping_city'] = $data['billing_city'];
			$data['shipping_postcode'] = $data['billing_postcode'];
			$data['billing_address_1'] = "Вул. {$data['street']}, дом {$data['building']}, кв {$data['apartment']}";
			$data['shipping_address_1'] = $data['billing_address_1'];

			$data['order_comments'] = "Способ доставки:\n{$data['shipping_method_value']} \n\nОплата:\n{$data['billing_payment_method']}\n\n" . $data['order_comments'];

			$cart_hash = md5( json_encode( wc_clean( $cart->get_cart_for_session() ) ) . $cart->total );
			$available_gateways = \WC()->payment_gateways->get_available_payment_gateways();

			// Loop through the data array
			foreach ( $data as $key => $value ) {
				// Use WC_Order setter methods if they exist
				if ( is_callable( array( $order, "set_{$key}" ) ) ) {
					$order -> {"set_{$key}"}( $value );

				// Store custom fields prefixed with wither shipping_ or billing_
				} elseif ( ( 0 === stripos( $key, 'billing_' ) || 0 === stripos( $key, 'shipping_' ) )
					&& ! in_array( $key, array( 'shipping_method', 'shipping_total', 'shipping_tax' ) ) ) {
					$order -> update_meta_data( '_' . $key, $value );
				}
			}

			$order->set_created_via( 'checkout' );
			$order->set_cart_hash( $cart_hash );
			$order->set_customer_id( apply_filters( 'woocommerce_checkout_customer_id', isset($_POST['user_id']) ? $_POST['user_id'] : '' ) );
			$order->set_currency( get_woocommerce_currency() );
			// $order->set_prices_include_tax( 'yes' === get_option( 'woocommerce_prices_include_tax' ) );
			$order->set_customer_ip_address( \WC_Geolocation::get_ip_address() );
			$order->set_customer_user_agent( wc_get_user_agent() );
			$order->set_customer_note( isset( $data['order_comments'] ) ? $data['order_comments'] : '' );
			$order->set_payment_method( isset( $available_gateways[ $data['payment_method'] ] ) ? $available_gateways[ $data['payment_method'] ]  : $data['payment_method'] );
			// $order->set_shipping_total( $cart->get_shipping_total() );
			// $order->set_discoun t_total( $cart->get_discount_total() );
			// $order->set_discount_tax( $cart->get_discount_tax() );
			// $order->set_cart_tax( $cart->get_cart_contents_tax() + $cart->get_fee_tax() );
			// $order->set_shipping_tax( $cart->get_shipping_tax() );
			$order->set_total( $cart->get_total( 'edit' ) );

			$checkout->create_order_line_items( $order, $cart );
			$checkout->create_order_fee_lines( $order, $cart );
			$checkout->create_order_shipping_lines( $order, \WC()->session->get( 'chosen_shipping_methods' ), \WC()->shipping->get_packages() );
			$checkout->create_order_tax_lines( $order, $cart );
			$checkout->create_order_coupon_lines( $order, $cart );

			/**
			 * Action hook to adjust order before save.
			 * @since 3.0.0
			 */
			do_action( 'woocommerce_checkout_create_order', $order, $data );

			// Save the order.
			$order_id = $order->save();

			do_action( 'woocommerce_checkout_update_order_meta', $order_id, $data );

			\WC() -> cart -> empty_cart();

			echo 'New order created with order ID: #'.$order_id.'.' ;
		}
		die();
	}
}