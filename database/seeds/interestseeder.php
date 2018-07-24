<?php

use Illuminate\Database\Seeder;
use App\Interest;
use Carbon\Carbon;

class interestseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Interest::create([
          'interest'=>'health volunteerism',
          'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
          'slug'=>str_slug('health')
        ]);

        Interest::create([
          'interest'=>'general volunteerism',
          'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
          'slug'=>str_slug('general')
        ]);
    }
}
