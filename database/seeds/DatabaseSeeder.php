<?php
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Setting;
use Spatie\Permission\Models\Permission;
class DatabaseSeeder extends Seeder{
/**
 * * Seed the application's database.
 * *
 * * @return void
 * */
public function run(){
    $permissions = $this->defaultPermissions();
    foreach ($permissions as $perms) {
            Permission::firstOrCreate(['name' => $perms['name'],'module_name'=>$perms['module_name']]);
        }
    $this->command->info('Default Permissions added.');

    $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'superadmin']);
    if( $role->name == 'superadmin' ) {
            $this->createUser($role);
            $role->syncPermissions(Permission::all());
            $this->command->info('Admin granted all the permissions');
        }
    // \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
    //     \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'cms']);
    //     $this->command->info('Added only default Role.');
        $this->call(UserSeeder::class);

    Setting::create([
        'code' => 'application_logo',
        'type' => 'FILE',
        'label' => 'Application Logo',
        'value' => 'application_logo.png',
        'hidden' => '0',
    ]);
    Setting::create([
        'code' => 'favicon_logo',
        'type' => 'FILE',
        'label' => 'Favicon Logo',
        'value' => 'favicon_logo.ico',
        'hidden' => '0',
    ]);
    Setting::create([
        'code' => 'application_title',
        'type' => 'TEXT',
        'label' => 'Application Title',
        'value' => 'CallNRoam',
        'hidden' => '0',
    ]);
    Setting::create([
        'code' => 'copyright',
        'type' => 'TEXT',
        'label' => 'Copy Right',
        'value' => 'CallNRoam',
        'hidden' => '0',
    ]);
}

private function createUser($role)
    {
        $user = factory(\App\Models\User::class)->create();
        $user->assignRole($role->name);

        if( $role->name == 'superadmin' ) {
            $this->command->info('Here is your Super Admin details to login:');
            $this->command->warn($user->email);
            $this->command->warn('Password is "smn@1234"');
        }
    }

private function defaultPermissions(){
    return [
            ['name'=>'admin-list','module_name'=>'Admin Management'],['name'=>'admin-create','module_name'=>'Admin Management'],['name'=>'admin-edit','module_name'=>'Admin Management'],['name'=>'admin-delete','module_name'=>'Admin Management'],['name'=>'admin-show','module_name'=>'Admin Management'],

            ['name'=>'role-list','module_name'=>'Role Management'],['name'=>'role-create','module_name'=>'Role Management'],['name'=>'role-edit','module_name'=>'Role Management'],['name'=>'role-delete','module_name'=>'Role Management'],['name'=>'role-show','module_name'=>'Role Management'],

            ['name'=>'faq-list','module_name'=>'FAQ Management'],['name'=>'faq-create','module_name'=>'FAQ Management'],['name'=>'faq-edit','module_name'=>'FAQ Management'],['name'=>'faq-delete','module_name'=>'FAQ Management'],['name'=>'faq-show','module_name'=>'FAQ Management'],

            ['name'=>'faqquestionanswer-list','module_name'=>'FAQ Question Answer Management'],['name'=>'faqquestionanswer-create','module_name'=>'FAQ Question Answer Management'],['name'=>'faqquestionanswer-edit','module_name'=>'FAQ Question Answer Management'],['name'=>'faqquestionanswer-delete','module_name'=>'FAQ Question Answer Management'],['name'=>'faqquestionanswer-show','module_name'=>'FAQ Question Answer Management'],

            ['name'=>'cms-list','module_name'=>'CMS Management'],['name'=>'cms-create','module_name'=>'CMS Management'],['name'=>'cms-edit','module_name'=>'CMS Management'],['name'=>'cms-delete','module_name'=>'CMS Management'],['name'=>'cms-show','module_name'=>'CMS Management'],

            ['name'=>'offers-list','module_name'=>'Offers Management'],['name'=>'offers-create','module_name'=>'Offers Management'],['name'=>'offers-edit','module_name'=>'Offers Management'],['name'=>'offers-delete','module_name'=>'Offers Management'],['name'=>'offers-show','module_name'=>'Offers Management'],

            ['name'=>'offertemplate-list','module_name'=>'Offer Template Management'],['name'=>'offertemplate-create','module_name'=>'Offer Template Management'],['name'=>'offertemplate-edit','module_name'=>'Offer Template Management'],['name'=>'offertemplate-delete','module_name'=>'Offer Template Management'],['name'=>'offertemplate-show','module_name'=>'Offer Template Management'],

            ['name'=>'settings-list','module_name'=>'Settings Management'],['name'=>'settings-create','module_name'=>'Settings Management'],['name'=>'settings-edit','module_name'=>'Settings Management'],['name'=>'settings-delete','module_name'=>'Settings Management'],['name'=>'settings-show','module_name'=>'Settings Management'],

            ['name'=>'addontype-list','module_name'=>'Addon Type Management'],['name'=>'addontype-create','module_name'=>'Addon Type Management'],['name'=>'addontype-edit','module_name'=>'Addon Type Management'],['name'=>'addontype-delete','module_name'=>'Addon Type Management'],['name'=>'addontype-show','module_name'=>'Addon Type Management'],
        ];
    }
}
