<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ad;

class SuspendAds extends Command
{
    protected $signature = 'ads:suspend';
    protected $description = 'Suspend ads where the deactivate_at date has passed';

    public function handle()
    {
        $now = now();
        $ads = Ad::where('status', Ad::PUBLISHED)->where('deactivate_at', '<', $now)->get();

        foreach ($ads as $ad) {
            $ad->status=Ad::SUSPENDED;
            $ad->deactivate_at=null;
            $ad->save();
        }

        $this->info(count($ads) . ' ads were suspended.');
    }
}