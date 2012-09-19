<?php
/**
 * Build pagination for posts list or post content
 * Based loosely on http://design.sparklette.net/teaches/how-to-add-wordpress-pagination-without-a-plugin/
 */

if ( ! class_exists( 'Noctilucent_Pagination' ) ) {
    
    class Noctilucent_Pagination {
        
		function __construct() {
			
			global $multipage, $numpages, $wp_query, $page, $paged;
			$this->multipage     = $multipage;
			$this->numpages      = $numpages;
			$this->max_num_pages = $wp_query->max_num_pages;
			$this->page          = $page;
			$this->paged         = $paged;
			
		}
		
        /**
         * Find the total number of pages available
         */
        function count_pages() {
			if ( is_singular() && $this->multipage ) {
				$pages = $this->numpages;
				if( ! $pages )
					$pages = 1;
			} else {
				$pages = $this->max_num_pages;
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
            if ( is_singular() && $this->multipage ) {
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
            if ( $this->multipage ) {
                if ( $this->page ) {
                    $this->paged = $this->page;
                } else {
                    $this->paged = 1;
                }
            } else if ( empty( $this->paged ) ) {
                $this->paged = 1;
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
                    $nav .= "<span class=\"pagination-label\">Page " . $this->paged . " of " . $pages . "</span>";
					
				// Left navigation items
                if ( $this->paged > 2 && $this->paged > $range + 1 && $showitems < $pages )
                    $nav .= $this->pagination_link( 1 ) . "\" class=\"pagination-nav pagination-first\">" . esc_html( $link_first ) . "</a>";
                if ( $this->paged > 1 )
                    $nav .= $this->pagination_link( $this->paged - 1 ) . "\" class=\"pagination-nav pagination-prev\">" . esc_html( $link_prev ) . "</a>";
                
				// Specific page numbers
                for ( $i = 1; $i <= $pages; $i++ ) {
					if ( ( ! ( $i >= $this->paged + $range + 1 || $i <= $this->paged - $range - 1 ) ) || ( $i <= $showitems && $this->paged + $range + 1 <= $showitems ) || ( $pages - $i + 1 <= $showitems && $pages - $this->paged + $range + 1 <= $showitems ) ) {
                        $nav .= ( $this->paged == $i ) ? $this->pagination_link( $i ) . "\" class=\"page-num current-page-num\">" . $i . "</a>" : $this->pagination_link( $i ) . "\" class=\"page-num\">" . $i . "</a>";
                    }
                }
                
				// Right navigation items
                if ( $this->paged < $pages )
                    $nav .= $this->pagination_link( $this->paged + 1 ) . "\" class=\"pagination-nav pagination-next\">" . esc_html( $link_next ) . "</a>";
                if ( $this->paged < $pages - 1 && $this->paged + $range - 1 < $pages && $showitems < $pages )
                    $nav .= $this->pagination_link( $pages ) . "\" class=\"pagination-nav pagination-last\">" . esc_html( $link_last ) . "</a>";
                
				// Close container element
				if ( $container )
					$nav .= "\n</" . $container . ">\n";
				
                return $nav;
			
            } else {
				
				return false;
			
			}
        }
    
    } // End class Noctilucent_Pagination

	/**
	 * Pagination template tag
	 */
    function noctilucent_pagination( $context = 'single', $echo = true, $args = null ) {
        
		$p = new Noctilucent_Pagination();
		
        if ( $context == 'single' && is_singular() ) {
            if ( $echo == true ) {
                echo $p->pagination( $args );
            } else {
                return $p->pagination( $args );
            }
        } else if ( $context == 'archive' && ! is_singular() ) {
            if ( $echo == true ) {
                echo $p->pagination( $args );
            } else {
                return $p->pagination( $args );
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
