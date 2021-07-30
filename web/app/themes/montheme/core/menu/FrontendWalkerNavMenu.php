<?php

if (!class_exists('FrontendWalkerNavMenu')) {
    class FrontendWalkerNavMenu extends Walker_Nav_Menu {

        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
            $classes = empty($item->classes) ? array() : (array) $item->classes;

            if (0 == $depth) {
                $classes[] = 'menu-item-swp';
            }

            $item->classes = $classes;

            parent::start_el($output, $item, $depth, $args, $id);
        }
    }
}
?>