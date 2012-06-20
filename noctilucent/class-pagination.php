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
        function count_pages( $pages = '' ) {
            if ( $pages == '' ) {
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
        function pagination( $label = true, $range = 4, $pages = '' ) {
            $showitems = ( $range * 2 ) + 1; 
            
            global $multipage, $page, $paged;
            if ( $multipage ) {
                if ( $page ) {
                    $paged = $page;
                } else {
                    $paged = 1;
                }
            } elseif ( empty( $paged ) ) {
                $paged = 1;
            }
            $pages = $this->count_pages( $pages );
         
            if ( 1 !== $pages ) {
                $nav = "<nav class=\"pagination\">\n";
                if ( $label == true )
                    $nav .= "<span>Page " . $paged . " of " . $pages . "</span>\n";
                if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages )
                    $nav .= $this->pagination_link( 1 ) . "\">&laquo; First</a>\n";
                if ( $paged > 1 )
                    $nav .= $this->pagination_link( $paged - 1 ) . "\">&lsaquo; Previous</a>\n";
                
                for ( $i = 1; $i <= $pages; $i++ ) {
                    if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) )
                        $nav .= ( $paged == $i ) ? $this->pagination_link( $i ) . "\" class=\"page-num current-page-num\">" . $i . "</a>" : $this->pagination_link( $i ) . "\" class=\"page-num\">" . $i . "</a>\n";
                }
                
                if ( $paged < $pages )
                    $nav .= $this->pagination_link( $paged + 1 ) . "\">Next &rsaquo;</a>\n";
                if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages )
                    $nav .= $this->pagination_link( $pages ) . "\">Last &raquo;</a>\n";
                $nav .= "</nav>\n";
                return $nav;
            }
        }
    
    } // End class Noctilucent_Pagination

    function noctilucent_pagination( $context = 'single', $echo = true ) {
        $p = new Noctilucent_Pagination();
        if ( $context == 'single' && is_singular() && 1 != $p->count_pages() ) {
            if ( $echo == true ) {
                echo $p->pagination();
            } else {
                return $p->pagination();
            }
        } else if ( $context == 'multi' && ! is_singular() && 1 != $p->count_pages() ) {
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
        }
    }

} // End if

?>