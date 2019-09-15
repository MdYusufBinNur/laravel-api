<?php

namespace App\Listeners\Fdi;

use App\DbModels\Fdi;
use App\DbModels\FdiLog;
use App\Events\Fdi\FdiCreatedEvent;
use App\Events\Fdi\FdiUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\FdiLogRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleFdiUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param FdiCreatedEvent $event
     * @return void
     */
    public function handle(FdiUpdatedEvent $event)
    {
        $fdi = $event->fdi;
        $eventOptions = $event->options;
        $oldFdi = $eventOptions['oldModel'];

        $fdiLogRepository = app(FdiLogRepository::class);

        $changedData = $this->getChangedData($fdi, $oldFdi);

        // log changes
        if (!empty($changedData)) {
            $fdiLogRepository->save([
                'fdiId' => $fdi->id,
                'userId' => $fdi->createdByUserId,
                'type' => $this->getTypeByChangedData($changedData),
                'status' => $fdi->status,
                'text' =>  $this->getTextByStatus($fdi->status),
            ]);
        }

    }

    /**
     * get text by status
     *
     * @param string $status
     * @return string
     */
    private function getTextByStatus($status)
    {
        $text = '';
        switch ($status) {
            case Fdi::STATUS_ACTIVE:
                $text = 'Activated';
                break;
            case Fdi::STATUS_PENDING_APPROVAL:
                $text = 'Pending for approval';
                break;
            case Fdi::STATUS_DENIED:
                $text = 'Denied';
                break;
            case Fdi::STATUS_EXPIRED:
                $text = 'Expired';
                break;
            case Fdi::STATUS_DELETED:
                $text = 'Deleted';
                break;
        }

        return $text;
    }

    private function getTypeByChangedData($changedData)
    {
        $type = '';
        if (array_key_exists('status', $changedData)) {
            $type = $changedData['status'];
        } else {
            if (isset($changedData)) {
                $type = FdiLog::TYPE_EDIT;
            }
        }
        return $type;
    }
}
