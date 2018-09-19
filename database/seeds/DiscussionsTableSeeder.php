<?php

use Illuminate\Database\Seeder;

class DiscussionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Discussion::class,20)->create();
        $discussion = DB::table('discussions')->get();

        foreach ($discussion as $discuss)
        {
            $slug = str_slug($discuss->title);
            DB::table('discussions')
                ->where('id', $discuss->id)
                ->update(['slug' => $slug]);
        }
    }
}
