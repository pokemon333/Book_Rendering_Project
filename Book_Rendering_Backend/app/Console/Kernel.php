<?php

namespace App\Console;

use App\Models\Book;
use App\Models\File;
use App\Models\Image;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Storage;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $book = Book::all()->pluck('image_id')->toArray();
            $images = Image::whereNotIn('id',$book)->pluck('image');
            Image::whereNotIn('id',$book)->delete();
            foreach ($images as $image) {
                Storage::delete('image/'.$image);
            }

            $book = Book::all()->pluck('file_id')->toArray();
            $files = File::whereNotIn('id',$book)->pluck('file');
                File::whereNotIn('id',$book)->delete();
            foreach ($files as $file) {
                Storage::delete('pdf/'.$file);
            }
        }) ->timezone('Asia/Yangon')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
