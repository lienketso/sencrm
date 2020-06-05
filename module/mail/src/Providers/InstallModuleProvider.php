<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 22/09/2018
 * Time: 10:45
 */

namespace Mail\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class InstallModuleProvider extends ServiceProvider
{
    protected $module = 'Mail';

    public function boot()
    {
        $this->app->booted(function () {
            $this->booted();
        });
    }

    public function register()
    {

    }

    public function booted()
    {
        $permission = [
            [
                'name' => 'mail_index',
                'display_name' => 'Mail Template Index',
                'description' => 'List Mail Template in system'
            ],
            [
                'name' => 'mail_create',
                'display_name' => 'Mail Template Create',
                'description' => 'Create new mail template in system'
            ],
            [
                'name' => 'mail_edit',
                'display_name' => 'Edit Mail Template',
                'description' => 'Edit mail template in system'
            ],
            [
                'name' => 'mail_delete',
                'display_name' => 'Mail Template Delete',
                'description' => 'Delete Mail Template'
            ],
        ];

        if (Schema::hasTable('permissions')) {
            acl_permission($this->module, $permission);
        }
    }
}