<?php

return [
    'userManagement' => [
        'title'          => 'จัดการผู้ใช้',
        'title_singular' => 'จัดการผู้ใช้',
    ],
    'permission'     => [
        'title'          => 'การอนุญาต',
        'title_singular' => 'การอนุญาต',
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
    'role'           => [
        'title'          => 'หน้าที่',
        'title_singular' => 'หน้าที่',
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
    'user'           => [
        'title'          => 'ผู้ใช้งาน',
        'title_singular' => 'ผู้ใช้งาน',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
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
        ],
    ],
    'auditLog'       => [
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
    'slider'         => [
        'title'          => 'Slider',
        'title_singular' => 'Slider',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'header'               => 'Header',
            'header_helper'        => 'ชื่อแสดงบนสุด',
            'header_second'        => 'Header Second',
            'header_second_helper' => 'รายละเอียดบรรทัดที่ 2',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'status'               => 'Status',
            'status_helper'        => 'สถานะที่แสดงบนเว็บไซต์',
            'detail'               => 'Detail',
            'detail_helper'        => 'รายละเอียด',
            'image_slider'         => 'Image Slider',
            'image_slider_helper'  => 'เลือกรูปที่แสดง (เลือกวีดีโอหรือรูปภาพแสดงได้อย่างใดอย่างหนึ่ง)',
            'video'                => 'video',
            'video_helper'         => 'เลือกวีดีโอที่แสดง (เลือกวีดีโอหรือรูปภาพแสดงได้อย่างใดอย่างหนึ่ง)',
        ],
    ],
    'ourTeam'        => [
        'title'          => 'Our Team',
        'title_singular' => 'Our Team',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'name'                 => 'Name',
            'name_helper'          => 'ชื่อสมาชิค',
            'position'             => 'Position',
            'position_helper'      => 'ตำแหน่งในบริษัทหรืองานที่ทำ',
            'detail_person'        => 'Detail Person',
            'detail_person_helper' => 'รายละเอียดเกี่ยวกับตัวบุคคล',
            'image'                => 'Image',
            'image_helper'         => 'รูปกรุณาเป็นรูปแนวตั้ง ขนาดประมาณ (525 * 390)',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'ourClient'      => [
        'title'          => 'Our Clients',
        'title_singular' => 'Our Client',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'name'                => 'Name',
            'name_helper'         => 'ชื่อลูกค้า',
            'logo_company'        => 'Logo Company',
            'logo_company_helper' => 'logo size (80*80)',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'logl_bw'             => 'Logo Black and White',
            'logl_bw_helper'      => ' ',
        ],
    ],
    'growupCategory' => [
        'title'          => 'Growup Category',
        'title_singular' => 'Growup Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => 'ชื่อประเภท',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'growupPage'     => [
        'title'          => 'Growup Page',
        'title_singular' => 'Growup Page',
    ],
    'ourPage'        => [
        'title'          => 'Our Page',
        'title_singular' => 'Our Page',
    ],
    'growupBlog'     => [
        'title'          => 'Growup Blog',
        'title_singular' => 'Growup Blog',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'blog_name'         => 'Blog Name',
            'blog_name_helper'  => 'ชื่อ Blog',
            'name_write'        => 'Name Write',
            'name_write_helper' => ' ',
            'image'             => 'Image',
            'image_helper'      => 'รูปภาพแสดงหน้า Blog',
            'detail'            => 'Detail',
            'detail_helper'     => 'เนื้อหาของ Blog',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'type'              => 'Type',
            'type_helper'       => 'ประเภทของเนื้อหา',
        ],
    ],
    'workPage'       => [
        'title'          => 'Work Page',
        'title_singular' => 'Work Page',
    ],
    'workCategory'   => [
        'title'          => 'Work Category',
        'title_singular' => 'Work Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'type_name'         => 'Type Name',
            'type_name_helper'  => 'ชื่อประเภทผลงาน',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'work'           => [
        'title'          => 'Work',
        'title_singular' => 'Work',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'name_work'             => 'Name Work',
            'name_work_helper'      => 'ชื่อผลงาน',
            'type_of_work'          => 'Type Of Work',
            'type_of_work_helper'   => 'ประเภทผลงาน สามารถเลือกได้มากกว่า 1',
            'clients'               => 'Clients',
            'clients_helper'        => 'ลูกค้าที่เกี่ยวข้องกับงาน',
            'work_detail'           => 'Work Detail',
            'work_detail_helper'    => 'รายละเอียดเกี่ยวกับผลงาน',
            'header_image'          => 'Header Image',
            'header_image_helper'   => 'รูปหน้าปก',
            'all_work_image'        => 'All Work Image',
            'all_work_image_helper' => 'รูปผลงานทั้งหมด สามารถเลือกได้หลายรูป',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'serch_tag'             => 'Serch Tag',
            'serch_tag_helper'      => 'tag สำหรับการค้นหา',
        ],
    ],
    'contactUs'      => [
        'title'          => 'Contact Us',
        'title_singular' => 'Contact Us',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'name'                => 'Name',
            'name_helper'         => 'ชื่อผู้ติดต่อ',
            'email'               => 'Email',
            'email_helper'        => 'อีเมลผู้ติดต่อ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'phone_number'        => 'Phone Number',
            'phone_number_helper' => ' ',
        ],
    ],
    'metadata'       => [
        'title'          => 'Setting',
        'title_singular' => 'Setting',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'setting'             => 'Setting',
            'setting_helper'      => ' ',
            'detail'              => 'Detail',
            'detail_helper'       => ' ',
            'detail_image'        => 'Detail Image',
            'detail_image_helper' => 'ใช้สำหรับ logo หรือ icon',
        ],
    ],
    'serchTag'       => [
        'title'          => 'Serch Tag',
        'title_singular' => 'Serch Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
];
