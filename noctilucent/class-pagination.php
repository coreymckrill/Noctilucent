<?php
/**
 * Build pagination for posts list or post content
 * Based loosely on http://design.sparklette.net/teaches/how-to-add-wordpress-pagination-without-a-plugin/
 */

if ( ! class_exists( 'Noctilucent_Pagination' ) ) {
    
    class Noctilucent_Pagination {
        
        /**
         * Find the total number of pages available
         */
        function count_pages() {
			global $multipage, $numpages, $wp_query;
			if ( is_singular() && $multipage ) {
				$pages = $numpages;
				if( ! $pages )
					$pages = 1;
			} else {
				$pages = $wp_query->max_num_pages;
				if( ! $pages )
					$pages = 1;
			}
            return $pages;
        }
        
        /**
         * Build the anchor tag for a particular page
         * Note: the closing > is not included.
         */
        function pagination_link( $i ) {
            global $multipage;
            if ( is_singular() && $multipage ) {
                $link = _wp_link_page( $i );
                $link = preg_replace( '/">/', '', $link );
            } else {
                $link = '<a href="' . get_pagenum_link( $i );
            }
            return $link;
        }
        
        /**
         * Compile pagination link list
         */
        function pagination( $args = null ) {
            $defaults = array(
				'label'           => true,
				'range'           => 4,
				'container'       => 'nav',
				'container_class' => 'pagination',
				'container_id'    => '',
				'link_first'      => '&laquo; First',
				'link_prev'       => '&lsaquo; Previous',
				'link_next'       => 'Next &rsaquo;',
				'link_last'       => 'Last &raquo;'
			);
			$args = wp_parse_args( $args, $defaults );
			extract( $args, EXTR_SKIP );
			
			if ( ! is_int( $range ) )
				$range = $defaults['range'];
			$showitems = ( $range * 2 ) + 1;
            
			// Get current page number
            global $multipage, $page, $paged;
            if ( $multipage ) {
                if ( $page ) {
                    $paged = $page;
                } else {
                    $paged = 1;
                }
            } else if ( empty( $paged ) ) {
                $paged = 1;
            }
			
			// Begin compilation
            $pages = $this->count_pages();
            if ( 1 != $pages ) {
                
				// Container attributes
				if ( $container )
					$container = ( $container == 'div' ) ? 'div' : 'nav';
				if ( $container_class )
					$container_class = ' class="' . esc_attr( $container_class ) . '"';
				if ( $container_id )
					$container_id = ' id="' . esc_attr( $container_id ) . '"';
				
				// Open container element
				$nav = '';
				if ( $container )
					$nav .= "<" . $container . $container_id . $container_class . ">\n";
                
				// Link list label, ie. Page 1 of 5
				if ( $label === true )
                    $nav .= "<span class=\"pagination-label\">Page " . $paged . " of " . $pages . "</span>";
					
				// Left navigation items
                if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages )
                    $nav .= $this->pagination_link( 1 ) . "\" class=\"pagination-first\">" . esc_html( $link_first ) . "</a>";
                if ( $paged > 1 )
                    $nav .= $this->pagination_link( $paged - 1 ) . "\" class=\"pagination-prev\">" . esc_html( $link_prev ) . "</a>";
                
				// Specific page numbers
                for ( $i = 1; $i <= $pages; $i++ ) {
					if ( ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) ) || ( $i <= $showitems && $paged + $range + 1 <= $showitems ) || ( $pages - $i + 1 <= $showitems && $pages - $paged + $range + 1 <= $showitems ) ) {
                        $nav .= ( $paged == $i ) ? $this->pagination_link( $i ) . "\" class=\"page-num current-page-num\">" . $i . "</a>" : $this->pagination_link( $i ) . "\" class=\"page-num\">" . $i . "</a>";
                    }
                }
                
				// Right navigation items
                if ( $paged < $pages )
                    $nav .= $this->pagination_link( $paged + 1 ) . "\" class=\"pagination-next\">" . esc_html( $link_next ) . "</a>";
                if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages )
                    $nav .= $this->pagination_link( $pages ) . "\" class=\"pagination-last\">" . esc_html( $link_last ) . "</a>";
                
				// Close container element
				if ( $container )
					$nav .= "\n</" . $container . ">\n";
				
                return $nav;
			
            } else {
				
				return false;
			
			}
        }
    
    } // End class Noctilucent_Pagination

    function noctilucent_pagination( $context = 'single', $echo = true ) {
        
		$p = new Noctilucent_Pagination();
		
        if ( $context == 'single' && is_singular() ) {
            if ( $echo == true ) {
                echo $p->pagination();
            } else {
                return $p->pagination();
            }
        } else if ( $context == 'archive' && ! is_singular() ) {
            if ( $echo == true ) {
                echo $p->pagination();
            } else {
                return $p->pagination();
            }
        } else if ( $context == 'count' ) {
            if ( $echo == true ) {
                echo $p->count_pages();
            } else {
                return $p->count_pages();
            }
        } else {
			return false;
		}
		
    }

} // End if

?>