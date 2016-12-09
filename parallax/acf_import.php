<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_5848e803cb169',
	'title' => 'Contenido',
	'fields' => array (
		array (
			'key' => 'field_584a258ee9a38',
			'label' => 'Título',
			'name' => 'parallax_title',
			'type' => 'text',
			'instructions' => 'Ingresa un título o deja en blanco la caja de texto si no quieres mostrarlo.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 100,
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
			'key' => 'field_584a2508e07ce',
			'label' => 'Texto',
			'name' => 'parallax_text',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 100,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
		),
		array (
			'key' => 'field_5848e87760b0b',
			'label' => 'Imagen',
			'name' => 'parallax_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 100,
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'parallax',
			),
		),
	),
	'menu_order' => 1,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
		0 => 'the_content',
	),
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array (
	'key' => 'group_584a32cba8dd7',
	'title' => 'Configuración',
	'fields' => array (
		array (
			'key' => 'field_584a32e1da586',
			'label' => 'Posición',
			'name' => 'parallax_position',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'default_value' => 50,
			'placeholder' => '',
			'prepend' => '',
			'append' => '%',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_584a3363da587',
			'label' => 'Inercia',
			'name' => 'parallax_inertia',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'default_value' => '0.1',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => 4,
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_584a338ada588',
			'label' => 'Alto',
			'name' => 'parallax_height',
			'type' => 'number',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_584a3e5afe2bb',
			'label' => 'Posición del Contenido',
			'name' => 'parallax_content_position',
			'type' => 'select',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				0 => 'Centro',
				1 => 'Derecha',
				2 => 'Izquierda',
			),
			'default_value' => array (
				0 => 0,
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
			'key' => 'field_584a3ed8fe2bc',
			'label' => 'Ancho del Contenido',
			'name' => 'parallax_content_width',
			'type' => 'number',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 0,
			'max' => '',
			'step' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'parallax',
			),
		),
	),
	'menu_order' => 2,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
		0 => 'the_content',
	),
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array (
	'key' => 'group_584a343398e71',
	'title' => 'Parallax internos',
	'fields' => array (
		array (
			'key' => 'field_5848e89c60b0c',
			'label' => 'Agrega, modifica o elimina',
			'name' => 'parallax_childs',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 1,
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
			'button_label' => 'Agregar Parallax',
			'sub_fields' => array (
				array (
					'key' => 'field_5848e8c960b0d',
					'label' => 'Posición',
					'name' => 'parallax_position',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => 25,
						'class' => '',
						'id' => '',
					),
					'default_value' => 50,
					'placeholder' => '',
					'prepend' => '',
					'append' => '%',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_5848e91660b0e',
					'label' => 'Inercia',
					'name' => 'parallax_inertia',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => 25,
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
					'key' => 'field_5848e94360b0f',
					'label' => 'Imagen',
					'name' => 'parallax_image',
					'type' => 'image',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => 50,
						'class' => '',
						'id' => '',
					),
					'return_format' => 'url',
					'preview_size' => 'medium',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'parallax',
			),
		),
	),
	'menu_order' => 2,
	'position' => 'normal',
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