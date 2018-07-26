<?php

namespace App\Listeners;

use App\Events\ContentCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;

class ManipulateMedia implements ShouldQueue
{
    /* Make sure we can use the queue function */
    use InteractsWithQueue;

    /* Specify the queue to use */
    public $queue = 'media';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ContentCreated  $event
     * @return void
     */
    public function handle(ContentCreated $event)
    {
        $content = $event->content;

        if ($content->type === 'media') {
            if ($this->validateMedia($content)) {
                $this->manipulateMedia($content);
            }
        }
    }

    /**
     * Check if the media can be manipulated (ie. image processing)
     *
     * @param  $content
     * @return bool
     */
    protected function validateMedia($content)
    {
        return !$content->parent_id && $content->mimeTypeIsManipulatable();
    }

    /**
     * Manipulate the media and create different images of various sizes
     *
     * @param  $content
     * @return void
     */
    protected function manipulateMedia($content)
    {
        $folder_path = Storage::disk($content->meta['disk'])->path("{$content->content}");

        $new_filename = "thumb-{$content->name}";

        $media = Image::load($content->image_path)
               ->width(100)
               ->height(100)
               ->save("{$folder_path}/{$new_filename}");

        $child_media = [
            'name' => $new_filename,
            'contentable_id' => $content->contentable_id,
            'contentable_type' => $content->contentable_type,
            'content' => $content->content,
            'type' => $content->type,
            'meta' => [
                'disk' => $content->meta['disk'],
                'mime' => $content->meta['mime'],
                'size' => '',
            ],
        ];

        $this->saveChildContent($content, $child_media);
    }

    /**
     * Save the meta of the media manipulation to get URLs
     *
     * @param  $content
     * @return void
     */
    protected function saveChildContent($content, $media)
    {
        $new_media = $content->children()->create($media);

        /* Get the size of the new thumbnail and update the database entry */
        $size = Storage::disk($new_media->meta['disk'])->size("{$new_media->content}/{$new_media->name}");
        $meta = $new_media->meta;
        $meta['size'] = $size;
        $new_media->update([
            'meta' => $meta
        ]);
    }
}
