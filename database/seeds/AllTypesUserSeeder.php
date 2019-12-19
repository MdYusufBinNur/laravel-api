<?php

use Illuminate\Database\Seeder;

class AllTypesUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //insert a Standard admin user
        $user = factory(App\DbModels\User::class)->create(['name' => 'Standard Admin', 'email' => 'standard_admin@reformedtech.org', 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => $user->id, 'roleId' => 2]);
        factory(App\DbModels\Admin::class)->create(['userId' => $user->id, 'userRoleId' => $userRoleId->id, 'level' => 'standard_admin' ]);

        //insert a Limited admin user
        $user = factory(App\DbModels\User::class)->create(['name' => 'Limited Admin', 'email' => 'limited_admin@reformedtech.org', 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => $user->id, 'roleId' => 3]);
        factory(App\DbModels\Admin::class)->create(['userId' => $user->id, 'userRoleId' => $userRoleId->id, 'level' => 'limited_admin' ]);

        //insert a Enterprise admin
        $user = factory(App\DbModels\User::class)->create(['name' => 'Enterprise Admin', 'email' => 'enterprise_admin@reformedtech.org', 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => $user->id, 'roleId' => 4]);
        factory(App\DbModels\EnterpriseUser::class)->create([
            'userId' => $user->id,
            'userRoleId' => $userRoleId->id,
            'level' => 'enterprise_admin',
            'companyId' => 1,
            'contactEmail' => 'enterprise_admin@reformedtech.org',
            'phone' => '01521000000',
            'title' => 'manager',
        ]);

        //insert a Enterprise standard admin
        $user = factory(App\DbModels\User::class)->create(['name' => 'Enterprise Standard Admin', 'email' => 'enterprise_standard@reformedtech.org', 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => $user->id, 'roleId' => 5, 'propertyId' => 1]);
        factory(App\DbModels\EnterpriseUser::class)->create([
            'userId' => $user->id,
            'userRoleId' => $userRoleId->id,
            'level' => 'enterprise_standard',
            'companyId' => 1,
            'contactEmail' => 'enterprise_standard@reformedtech.org',
            'phone' => '01521000000',
            'title' => 'manager',
        ]);

        //insert a Priority staff
        $user = factory(App\DbModels\User::class)->create(['name' => 'Priority Staff', 'email' => 'priority_staff@reformedtech.org', 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => $user->id, 'roleId' => 6, 'propertyId' => 1]);
        factory(App\DbModels\Manager::class)->create([
            'userId' => $user->id,
            'userRoleId' => $userRoleId->id,
            'level' => 'priority_staff',
            'contactEmail' => 'priority_staff@reformedtech.org',
            'phone' => '01521000000',
            'title' => 'staff',
            'propertyId' => 1,
            'displayInCorner' => true,
            'displayPublicProfile' => true
        ]);

        //insert a Priority staff
        $user = factory(App\DbModels\User::class)->create(['name' => 'Standard Staff', 'email' => 'standard_staff@reformedtech.org', 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => $user->id, 'roleId' => 7, 'propertyId' => 1]);
        factory(App\DbModels\Manager::class)->create([
            'userId' => $user->id,
            'userRoleId' => $userRoleId->id,
            'level' => 'standard_staff',
            'contactEmail' => 'standard_staff@reformedtech.org',
            'phone' => '01521000000',
            'title' => 'staff',
            'propertyId' => 1,
            'displayInCorner' => true,
            'displayPublicProfile' => true
        ]);

        //insert a Priority staff
        $user = factory(App\DbModels\User::class)->create(['name' => 'Limited Staff', 'email' => 'limited_staff@reformedtech.org', 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => $user->id, 'roleId' => 8, 'propertyId' => 1]);
        factory(App\DbModels\Manager::class)->create([
            'userId' => $user->id,
            'userRoleId' => $userRoleId->id,
            'level' => 'limited_staff',
            'contactEmail' => 'limited_staff@reformedtech.org',
            'phone' => '01521000000',
            'title' => 'staff',
            'propertyId' => 1,
            'displayInCorner' => true,
            'displayPublicProfile' => true
        ]);

        //insert a Resident Owner
        $user = factory(App\DbModels\User::class)->create(['name' => 'Resident Owner', 'email' => 'resident_owner@reformedtech.org', 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => $user->id, 'roleId' => 9, 'propertyId' => 1]);
        factory(App\DbModels\Resident::class)->create([
            'userId' => $user->id,
            'userRoleId' => $userRoleId->id,
            'type' => 'resident_owner',
            'contactEmail' => 'resident_owner@reformedtech.org',
            'propertyId' => 1,
            'unitId' => 1,
        ]);

        //insert a Resident Owner
        $user = factory(App\DbModels\User::class)->create(['name' => 'Resident Tenant', 'email' => 'resident_tenant@reformedtech.org', 'password' => 'password', 'isActive' => 1]);
        $userRoleId = factory(App\DbModels\UserRole::class)->create(['userId' => $user->id, 'roleId' => 10, 'propertyId' => 1]);
        factory(App\DbModels\Resident::class)->create([
            'userId' => $user->id,
            'userRoleId' => $userRoleId->id,
            'type' => 'resident_tenant',
            'contactEmail' => 'resident_tenant@reformedtech.org',
            'propertyId' => 1,
            'unitId' => 1,
        ]);

    }
}
