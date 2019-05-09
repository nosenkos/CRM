<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Category::class, 50)->create();
        factory(\App\Models\Tag::class, 50)->create();

        \Illuminate\Support\Facades\DB::table('roles')->insert(['name'=>'administrator']);
        \Illuminate\Support\Facades\DB::table('roles')->insert(['name'=>'user']);

        factory(\App\Models\User::class, 50)->create()->each(function($u){
            $team = factory(\App\Models\Team::class)->make();
            $u->own_team()->save($team);
            $u->teams()->save($team);
            $u->roles()->attach(\App\Models\Role::all()->random()->id);
            $u->profile()->save(factory(\App\Models\Profile::class)->make());
            $u->projects()->saveMany(factory(\App\Models\Project::class, rand(3,10))->make())->each(function($p){
                $p->users()->attach(\App\Models\User::all()->random()->id);
                $p->categories()->attach(\App\Models\Category::all()->random()->id);
                $p->tags()->attach(\App\Models\Tag::all()->random()->id);
            });
            $u->clients()->saveMany(factory(\App\Models\Client::class,50)->make());
        });
    }
}
