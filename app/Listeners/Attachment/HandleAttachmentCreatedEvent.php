<?php

namespace App\Listeners\Attachment;

use App\Events\Attachment\AttachmentCreatedEvent;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class HandleAttachmentCreatedEvent implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param AttachmentCreatedEvent $event
     * @return void
     */
    public function handle(AttachmentCreatedEvent $event)
    {
        $attachment = $event->attachment;
        $eventOptions = $event->options;

        if(!empty($eventOptions['multipleTypes'])) {
            $directoryName = $attachment->getDirectoryName($attachment->type);
            $imageUrl = \Storage::temporaryUrl($directoryName . '/' . $attachment->fileName, Carbon::now()->addMinutes(10));

            $imageSizeTypes = explode(',', $eventOptions['multipleTypes']);
            foreach ($imageSizeTypes as $imageSizeType) {
                $imageSizes = $attachment->getImageSizeByTypeTitle($imageSizeType);
                $resizedImagePath = '/tmp/' . Str::random(10);

                $image = \Image::make($imageUrl)->resize($imageSizes['width'], $imageSizes['height'])->save($resizedImagePath);
                $filePath = $attachment->getAttachmentDirectoryPathByTypeTitle($imageSizeType);
                \Storage::put($filePath, $image, 'public');
            }

        }
    }
}
