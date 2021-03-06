<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'First name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'phone'                    => 'Phone',
            'phone_helper'             => ' ',
            'photo'                    => 'Photo',
            'photo_helper'             => ' ',
            'city'                     => 'City',
            'city_helper'              => ' ',
            'user_type'                => 'User Type',
            'user_type_helper'         => ' ',
            'last_name'                => 'Last name',
            'last_name_helper'         => ' ',
            'identity_photo'           => 'Identity Photo',
            'identity_photo_helper'    => ' ',
            'identity_num'             => 'Identity Num',
            'identity_num_helper'      => ' ',
            'city'                     => 'City',
            'city_helper'              => ' ',
            'city_manager'                     => 'City',
            'city_manager_helper'              => ' ',
        ],
        'manager_info'  => 'School Manager Information',
        'school_info'  => ' School Information',
    ],
    'userAlert' => [
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'school' => [
        'title'          => 'Schools',
        'title_singular' => 'School',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ', 
            'area'                 => 'Area',
            'area_helper'          => ' ',
            'sector'               => 'Sector',
            'sector_helper'        => ' ',
            'name'                 => 'Name',
            'name_helper'          => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'classificaion'        => 'Classificaion',
            'classificaion_helper' => ' ',
            'longitude'            => 'Longitude',
            'longitude_helper'     => ' ',
            'latitude'             => 'Latitude',
            'latitude_helper'      => ' ',
            'end_time'             => 'End Time',
            'end_time_helper'      => ' ',
            'start_time'           => 'Start Time',
            'start_time_helper'    => ' ',
            'user'                 => 'User',
            'user_helper'          => ' ',
            'city'                 => 'City',
            'city_helper'          => ' ',
        ],

    ],
    'screen' => [
        'title' => 'Screen Show',
    ],
    'student' => [
        'title'          => 'Students',
        'title_singular' => 'Student',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'number'                   => 'Number',
            'number_helper'            => ' ',
            'school'                   => 'School',
            'school_helper'            => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'academic_level'           => 'Academic Level',
            'academic_level_helper'    => ' ', 
            'user'                     => 'User',
            'user_helper'              => ' ',
            'identity_num'             => 'Identity Num',
            'identity_num_helper'      => ' ',
            'parent_identity'             => 'Identity Num Parent',
            'parent_identity_helper'      => ' ',
            'identitty_photo'          => 'Identitty Photo',
            'identitty_photo_helper'   => ' ',
            'class_number'             => 'Class Number',
            'class_number_helper'      => ' ',
            'parent_identity'        => 'Parent Identity',
            'parent_identity_helper' => ' ',
            'parent'                 => 'Parent',
            'parent_helper'          => ' ',
            'voice'                 => 'Voice',
            'voice_helper'          => ' ',
        ],
    ],
    'myParent' => [
        'title'          => 'My Parents',
        'title_singular' => 'My Parent',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'user'                     => 'User',
            'user_helper'              => ' ',
            'relative_relation'        => 'Relative Relation',
            'relative_relation_helper' => ' ',
            'company_name'             => 'Company Name',
            'company_name_helper'      => ' ',
            'license_number'           => 'License Number',
            'license_number_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'city' => [
        'title'          => 'Cities',
        'title_singular' => 'City',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name_ar'           => 'Name Ar',
            'name_ar_helper'    => ' ',
            'name_en'           => 'Name En',
            'name_en_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
];
