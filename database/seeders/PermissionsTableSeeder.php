<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'slider_create',
            ],
            [
                'id'    => 20,
                'title' => 'slider_edit',
            ],
            [
                'id'    => 21,
                'title' => 'slider_show',
            ],
            [
                'id'    => 22,
                'title' => 'slider_delete',
            ],
            [
                'id'    => 23,
                'title' => 'slider_access',
            ],
            [
                'id'    => 24,
                'title' => 'our_team_create',
            ],
            [
                'id'    => 25,
                'title' => 'our_team_edit',
            ],
            [
                'id'    => 26,
                'title' => 'our_team_show',
            ],
            [
                'id'    => 27,
                'title' => 'our_team_delete',
            ],
            [
                'id'    => 28,
                'title' => 'our_team_access',
            ],
            [
                'id'    => 29,
                'title' => 'our_client_create',
            ],
            [
                'id'    => 30,
                'title' => 'our_client_edit',
            ],
            [
                'id'    => 31,
                'title' => 'our_client_show',
            ],
            [
                'id'    => 32,
                'title' => 'our_client_delete',
            ],
            [
                'id'    => 33,
                'title' => 'our_client_access',
            ],
            [
                'id'    => 34,
                'title' => 'growup_category_create',
            ],
            [
                'id'    => 35,
                'title' => 'growup_category_edit',
            ],
            [
                'id'    => 36,
                'title' => 'growup_category_show',
            ],
            [
                'id'    => 37,
                'title' => 'growup_category_delete',
            ],
            [
                'id'    => 38,
                'title' => 'growup_category_access',
            ],
            [
                'id'    => 39,
                'title' => 'growup_page_access',
            ],
            [
                'id'    => 40,
                'title' => 'our_page_access',
            ],
            [
                'id'    => 41,
                'title' => 'growup_blog_create',
            ],
            [
                'id'    => 42,
                'title' => 'growup_blog_edit',
            ],
            [
                'id'    => 43,
                'title' => 'growup_blog_show',
            ],
            [
                'id'    => 44,
                'title' => 'growup_blog_delete',
            ],
            [
                'id'    => 45,
                'title' => 'growup_blog_access',
            ],
            [
                'id'    => 46,
                'title' => 'work_page_access',
            ],
            [
                'id'    => 47,
                'title' => 'work_category_create',
            ],
            [
                'id'    => 48,
                'title' => 'work_category_edit',
            ],
            [
                'id'    => 49,
                'title' => 'work_category_show',
            ],
            [
                'id'    => 50,
                'title' => 'work_category_delete',
            ],
            [
                'id'    => 51,
                'title' => 'work_category_access',
            ],
            [
                'id'    => 52,
                'title' => 'work_create',
            ],
            [
                'id'    => 53,
                'title' => 'work_edit',
            ],
            [
                'id'    => 54,
                'title' => 'work_show',
            ],
            [
                'id'    => 55,
                'title' => 'work_delete',
            ],
            [
                'id'    => 56,
                'title' => 'work_access',
            ],
            [
                'id'    => 57,
                'title' => 'contact_us_create',
            ],
            [
                'id'    => 58,
                'title' => 'contact_us_edit',
            ],
            [
                'id'    => 59,
                'title' => 'contact_us_show',
            ],
            [
                'id'    => 60,
                'title' => 'contact_us_delete',
            ],
            [
                'id'    => 61,
                'title' => 'contact_us_access',
            ],
            [
                'id'    => 62,
                'title' => 'metadata_edit',
            ],
            [
                'id'    => 63,
                'title' => 'metadata_show',
            ],
            [
                'id'    => 64,
                'title' => 'metadata_access',
            ],
            [
                'id'    => 65,
                'title' => 'serch_tag_create',
            ],
            [
                'id'    => 66,
                'title' => 'serch_tag_edit',
            ],
            [
                'id'    => 67,
                'title' => 'serch_tag_show',
            ],
            [
                'id'    => 68,
                'title' => 'serch_tag_delete',
            ],
            [
                'id'    => 69,
                'title' => 'serch_tag_access',
            ],
            [
                'id'    => 70,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
