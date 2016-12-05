<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_58449e0767d64',
	'title' => 'Slider',
	'fields' => array (
		array (
			'key' => 'field_5844f3e7f79c1',
			'label' => 'Plantilla',
			'name' => 'slider_template',
			'type' => 'select',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'default' => 'Default',
				'bar' => 'Bar',
				'dark' => 'Dark',
				'light' => 'Light',
			),
			'default_value' => array (
				'default' => 'default',
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		),
		array (
			'key' => 'field_58449e1073c94',
			'label' => 'Efectos',
			'name' => 'slider_effect',
			'type' => 'select',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'sliceDown' => 'Slice Down',
				'sliceDownLeft' => 'Slice Down Left',
				'sliceUp' => 'Slice Up',
				'sliceUpLeft' => 'Slice Up Left',
				'sliceUpDown' => 'Slice Up Down',
				'sliceUpDownLeft' => 'Slice Up Down Left',
				'fold' => 'Fold',
				'fade' => 'Fade',
				'random' => 'Random',
				'slideInRight' => 'Slice In Right',
				'slideInLeft' => 'Slice In Left',
				'boxRandom' => 'Box Random',
				'boxRain' => 'Box Rain',
				'boxRainReverse' => 'Box Rain Reverse',
				'boxRainGrow' => 'Box Rain Grow',
				'boxRainGrowReverse' => 'Box Rain Grow Reverse',
			),
			'default_value' => array (
				'random' => 'random',
			),
			'allow_null' => 0,
			'multiple' => 1,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		),
		array (
			'key' => 'field_5844a08ea37d1',
			'label' => 'Slices',
			'name' => 'slider_slices',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 15,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 2,
			'max' => 50,
			'step' => 1,
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_5844a172a37d2',
			'label' => 'Box Columns',
			'name' => 'slider_boxCols',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 8,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 2,
			'max' => 50,
			'step' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_5844a199a37d3',
			'label' => 'Box Rows',
			'name' => 'slider_boxRows',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 4,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 2,
			'max' => 50,
			'step' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_5844a2a0abf8f',
			'label' => 'Animation Speed',
			'name' => 'slider_animSpeed',
			'type' => 'number',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 500,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 100,
			'max' => 3000,
			'step' => 50,
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_5844a2e7abf90',
			'label' => 'Pause Time',
			'name' => 'slider_pauseTime',
			'type' => 'number',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 1000,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 1000,
			'max' => 30000,
			'step' => 100,
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_5844a3437a6dd',
			'label' => 'Show Next/Prev',
			'name' => 'slider_directionNav',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 1,
		),
		array (
			'key' => 'field_5844a3a77a6de',
			'label' => 'Show navigation Controls',
			'name' => 'slider_controlNav',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 1,
		),
		array (
			'key' => 'field_5844a3d47a6df',
			'label' => 'Use Thumbnails for Navigation',
			'name' => 'slider_controlNavThumbs',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
		),
		array (
			'key' => 'field_5844a40a7a6e0',
			'label' => 'Pausar en hover',
			'name' => 'slider_pauseOnHover',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 1,
		),
		array (
			'key' => 'field_5844a4b85161c',
			'label' => 'Slider manual',
			'name' => 'slider_manualAdvance',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
		),
		array (
			'key' => 'field_5844a5e0dc584',
			'label' => 'Texto: Anterior',
			'name' => 'prevText',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'Anterior',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => 20,
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_5844a624dc585',
			'label' => 'Texto: Siguiente',
			'name' => 'slider_nextText',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'Siguiente',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => 20,
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_5844a661ec057',
			'label' => 'Inicio Aleatorio',
			'name' => 'randomStart',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
		),
		array (
			'key' => 'field_5844e233faafa',
			'label' => 'Etiqueta HTML para título',
			'name' => 'slider_titleTag',
			'type' => 'select',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'p' => 'Párrafo',
				'h1' => 'Cabecera 1',
				'h2' => 'Cabecera 2',
				'h3' => 'Cabecera 3',
			),
			'default_value' => array (
				'p' => 'p',
			),
			'allow_null' => 1,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'slider',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'seamless',
	'label_placement' => 'left',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
		0 => 'the_content',
	),
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array (
	'key' => 'group_5844beb6c2a42',
	'title' => 'Slides',
	'fields' => array (
		array (
			'key' => 'field_5844beb7310d1',
			'label' => 'Slides',
			'name' => 'slider_slides',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => '',
			'max' => '',
			'layout' => 'block',
			'button_label' => 'Agregar Fila',
			'sub_fields' => array (
				array (
					'key' => 'field_5844beba53cee',
					'label' => 'Título',
					'name' => 'titulo',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_5844beba57a04',
					'label' => 'Texto',
					'name' => 'texto',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 0,
				),
				array (
					'key' => 'field_5844beba5b761',
					'label' => 'Imagen',
					'name' => 'imagen',
					'type' => 'image',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'url',
					'preview_size' => 'thumbnail',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
				array (
					'key' => 'field_5844bf52bb668',
					'label' => 'Enlace',
					'name' => 'enlace',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_5844eb508aaf2',
					'label' => 'Efecto',
					'name' => 'efecto',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array (
						'ninguno' => 'Sin Definir',
						'sliceDown' => 'Slice Down',
						'sliceDownLeft' => 'Slice Down Left',
						'sliceUp' => 'Slice Up',
						'sliceUpLeft' => 'Slice Up Left',
						'sliceUpDown' => 'Slice Up Down',
						'sliceUpDownLeft' => 'Slice Up Down Left',
						'fold' => 'Fold',
						'fade' => 'Fade',
						'random' => 'Random',
						'slideInRight' => 'Slice In Right',
						'slideInLeft' => 'Slice In Left',
						'boxRandom' => 'Box Random',
						'boxRain' => 'Box Rain',
						'boxRainReverse' => 'Box Rain Reverse',
						'boxRainGrow' => 'Box Rain Grow',
						'boxRainGrowReverse' => 'Box Rain Grow Reverse',
					),
					'default_value' => array (
						'ninguno' => 'ninguno',
					),
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0,
					'placeholder' => '',
					'disabled' => 0,
					'readonly' => 0,
				),
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'slider',
			),
		),
	),
	'menu_order' => 2,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
		0 => 'the_content',
	),
	'active' => 1,
	'description' => '',
));

endif;