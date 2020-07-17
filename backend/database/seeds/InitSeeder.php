<?php

use Illuminate\Database\Seeder;

class InitSeeder extends Seeder
{
    const USER_COUNT = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //ユーザ生成
        factory(App\Models\TrUser::class, self::USER_COUNT)->create()
            ->each(function (App\Models\TrUser $trUser) {
                $trUser->tr_user_profile()->saveMany(factory(App\Models\TrUserProfile::class, 1)->make());
            });

        //ユーザに紐づくデータ生成
        DB::table('tr_users')->get()->each(function ($trUser) {
            factory(App\Models\TrApplication::class, 4)->create(['tr_user_id' => $trUser->id])
                ->each(function (App\Models\TrApplication $trApplication) {
                    factory(App\Models\TrApplicationTag::class, 4)->create(['tr_application_id' => $trApplication->id]);
                    factory(App\Models\TrApplicationReport::class,
                        6)->create(['tr_application_id' => $trApplication->id]);
                    factory(App\Models\TrApplicationComment::class, 6)->create([
                        'tr_application_id' => $trApplication->id, 'tr_user_id' => random_int(1, self::USER_COUNT)
                    ]);
                });
        });
    }
}
