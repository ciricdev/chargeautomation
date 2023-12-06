<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Ultimate_Add_Dsicons {
    
    public function __construct() {
		add_action( 'elementor/controls/controls_registered', [ $this, 'ultimate_add_dsicons' ], 10, 1 );   
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'ultimate_enqueue_dsicons' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'ultimate_enqueue_dsicons' ] );    
	}    
    
    public function ultimate_enqueue_dsicons(){
        wp_enqueue_style( 'dsicon', ULTIMATE_ADDONS_ROOT_ICON . 'dsicons/dsicon.css', array(), '1.0.1' );
    }
    
    public function ultimate_add_dsicons( $controls_registry ){
	    $new_added_icons = array(
			'dsicon-001-mouse'          => 'mouse',
			'dsicon-002-wireframe'      => 'wireframe',
			'dsicon-003-magic-wand'     => 'magic wand',
			'dsicon-004-rgb'            => 'rgb',
			'dsicon-005-book'           => 'book',
			'dsicon-006-protractor'     => 'protractor',
			'dsicon-008-image'          => 'image',
			'dsicon-009-sketch-1'       => 'sketch 1',
			'dsicon-010-paint-bucket'   => 'paint bucket',
			'dsicon-012-opacity'        => 'opacity',
			'dsicon-013-settings'       => 'settings',
			'dsicon-014-3d-cube'        => '3d-cube',
			'dsicon-028-browser'        => 'browser',
			'dsicon-015-browser-1'      => 'browser 2',
			'dsicon-016-pantone'        => 'pantone',
			'dsicon-017-pencil-case'    => 'pencil case',
			'dsicon-018-sketch'         => 'sketch',
			'dsicon-019-text-editor'    => 'text editor',
			'dsicon-007-text-editor-1'  => 'text editor 2',
			'dsicon-020-laptop'         => 'laptop',
			'dsicon-021-eraser'         => 'eraser',
			'dsicon-036-idea'           => 'idea',
			'dsicon-022-idea-1'         => 'idea 2',
			'dsicon-023-visibility'     => 'visibility',
			'dsicon-024-creativity'     => 'creativity',
			'dsicon-025-reflect'        => 'reflect',
			'dsicon-026-target'         => 'target',
			'dsicon-027-lasso'          => 'lasso',
			'dsicon-029-crop'           => 'crop',
			'dsicon-030-graphic-design' => 'graphic-design',
			'dsicon-031-layout'         => 'layout',
			'dsicon-032-drawing'        => 'drawing',
			'dsicon-033-compass'        => 'compass',
			'dsicon-034-ruler'          => 'ruler',
			'dsicon-035-file'           => 'file',
			'dsicon-038-agenda'         => 'agenda',
			'dsicon-039-graphic-tablet' => 'graphic-tablet',
			'dsicon-040-pipette'        => 'pipette',
			'dsicon-041-layers'         => 'layers',
			'dsicon-042-tools'          => 'tools',
			'dsicon-043-paint-palette'  => 'paint-palette',
			'dsicon-044-transform'      => 'transform',
			'dsicon-045-paint-brush'    => 'paint brush',
			'dsicon-046-paint-spray'    => 'paint spray',
			'dsicon-047-paint-roller'   => 'paint roller',
			'dsicon-048-color-palette'  => 'color palette',
			'dsicon-049-ideas'          => 'ideas',
			'dsicon-050-vector'         => 'vector',
			'dsicon-037-vector-1'       => 'vector 2',
			'dsicon-011-vector-2'       => 'vector 3',
		);
	    $icons = $controls_registry->get_control( 'icon' )->get_settings( 'options' );
	    $controls_registry->get_control( 'icon' )->set_settings( 'options', array_merge( $icons, $new_added_icons ) );
	}
}
new Ultimate_Add_Dsicons();