<?php
class main_menu_walker extends Walker_Nav_Menu {
	function start_lvl( & $output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class='list-unstyled pr-3'>\n";
	}

	function end_lvl( & $output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "$indent</ul>\n";
	}

	function start_el( & $output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : ( array )$item->classes;
		$classes[] = 'fa';
		$classes[] = 'mx-3';
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"': '';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"': '';
		$output .= $indent . '';
		$attributes = !empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"': '';
		$attributes .= !empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"': '';
		$attributes .= !empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"': '';
		$attributes .= !empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"': '';
		$item_output = $args->before;
		$item_output .= '<li class="nav-item"><a' . $attributes . ' class="nav-link text-white">';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a></li>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el( & $output, $item, $depth = 0, $args = array() ) {
		$output .= "\n";
	}
}
class main_menu_walker_2 extends Walker_Nav_Menu {
	function start_lvl( & $output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent\n";
	}

	function end_lvl( & $output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "$indent\n";
	}

	function start_el( & $output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : ( array )$item->classes;
		$classes[] = 'fa';
		$classes[] = 'mb-3';
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"': '';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"': '';
		$output .= $indent . '';
		$attributes = !empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"': '';
		$attributes .= !empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"': '';
		$attributes .= !empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"': '';
		$attributes .= !empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"': '';
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . ' class="nav-item nav-link text-white mx-1"><i ' . $class_names . ' aria-hidden="true"></i><br>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el( & $output, $item, $depth = 0, $args = array() ) {
		$output .= "\n";
	}
}