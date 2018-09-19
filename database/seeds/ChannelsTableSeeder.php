<?php

use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$channel = ['Laravel','Vuejs','CSS3','Javascript','PHP Testing','Spark','Lumen','Forge'];
        $channel = ['title'=>'Laravel Framework','slug'=>str_slug('Laravel Framework')];
        $channel1=  ['title'=>'Vue js','slug'=>str_slug('Vue js')];
        $channel2 = ['title'=>'CSS3 Animation','slug'=>str_slug('Animation')];
        $channel3 = ['title'=>'Javascript ES8','slug'=>str_slug('Javascript ES8')];
        $channel4 = ['title'=>'PHP Testing','slug'=>str_slug('PHP Testing')];
        $channel5 = ['title'=>'Spark Package','slug'=>str_slug('Spark Package')];
        $channel6 = ['title'=>'Lumen Micro Framework','slug'=>str_slug('Lumen Micro Framework')];
        $channel7 = ['title'=>'Forge PHP Servers','slug'=>str_slug('Forge PHP Servers')];




        \App\Channel::create($channel);
        \App\Channel::create($channel1);
        \App\Channel::create($channel2);
        \App\Channel::create($channel3);
        \App\Channel::create($channel4);
        \App\Channel::create($channel5);
        \App\Channel::create($channel6);
        \App\Channel::create($channel7);


    }
}
