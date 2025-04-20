<?php

return [
    'resources' => [
        'experience' => [
            'label' => 'Experiencias',
            'form' => [
                'name' => [
                    'label' => 'Nombre PEPE',
                ],
                'position' => [
                    'label' => 'Puesto',
                ],
                'company' => [
                    'label' => 'Empresa',
                ],
                'company_url' => [
                    'label' => 'Sitio web',
                ],
                'start_date' => [
                    'label' => 'Fecha de inicio',
                ],
                'end_date' => [
                    'label' => 'Fecha de salida de la empresa',
                ],
                'is_freelancer' => [
                    'label' => 'Puesto como freelancer',
                ],
                'description' => [
                    'label' => 'Descripción',
                ],
                'technologies' => [
                    'label' => 'Tecnologías',
                ],
                'location' => [
                    'label' => 'Ubicación',
                ],
            ],
            'table' => [
                'position' => [
                    'label' => 'Puesto',
                ],
                'company' => [
                    'label' => 'Compañía    ',
                ]
            ],
        ],
        'load_experiences' => 'Cargar experiencias',
        'projects' => [
            'label' => 'Proyectos',
            'form' => [
                'user_id' => [
                    'label' => 'Usuario',
                ],
                'is_active' => [
                    'label' => 'Está activo',
                ],
                'title' => [
                    'label' => 'Título',
                ],
                'description' => [
                    'label' => 'Descripción',
                ],
                'url' => [
                    'label' => 'URL del proyecto',
                ],
                'technologies' => [
                    'label' => 'Tecnologías',
                ],
                'start_date' => [
                    'label' => 'Fecha de inicio',
                ],
                'end_date' => [
                    'label' => 'Fecha de finalización',
                ],
            ],
            'table' => [
                'title' => [
                    'label' => 'Título',
                ],
                'user' => [
                    'label' => 'Usuario',
                ],
                'is_active' => [
                    'label' => 'Activo',
                ],
                'url' => [
                    'label' => 'URL',
                ],
                'start_date' => [
                    'label' => 'Fecha inicio',
                ],
                'end_date' => [
                    'label' => 'Fecha fin',
                ],
            ],
        ],
    ],
    'profile' => [
        'label' => 'Mi perfil',
        'updated' => '¡Perfil actualizado!',
        'update_failed' => 'Error al actualizar el perfil',
        'try_again' => 'Ocurrió un problema. Intenta nuevamente más tarde.',
        'avatar' => [
            'label' => 'Avatar',
        ],
        'name' => [
            'label' => 'Nombre',
        ],
        'email' => [
            'label' => 'Correo electrónico',
        ],
        'phone' => [
            'label' => 'Teléfono',
        ],
        'address' => [
            'label' => 'Dirección',
        ],
        'bio' => [
            'label' => 'Sobre mi',
        ],
        'actions' => [
            'update' => 'Actualizar perfil',
            'generate-cv' => 'Generar CV',
        ],
        'title' => 'Información del Perfil',
        'description' => 'Actualiza la información de tu perfil y dirección de correo electrónico.',
        'social' => [
            'title' => 'Redes Sociales',
            'description' => 'Agrega enlaces a tus perfiles de redes sociales.',
        ],
        'github' => [
            'label' => 'GitHub URL',
        ],
        'twitter' => [
            'label' => 'X (Twitter) URL',
        ],
        'linkedin' => [
            'label' => 'LinkedIn URL',
        ],
        'notifications' => [
            'update' => [
                'success' => 'Perfil actualizado',
            ],
        ],
        'professional_experience' => 'Experiencia Profesional',
        'projects' => 'Proyectos'
    ],
];
