<?php

namespace App\Services\SMS\SMSMicroService;

use App\Services\SMS\SMS;

class SMSMicroService extends Base implements SMS
{
    /**
     * @inheritDoc
     */
    public function send($toMobileNumber, string $text, array $options = [])
    {
        $data = [
            'numbers' => $toMobileNumber,
            'text' => $text,
            'provider' => $options['provider'] ?? env('MS_SMS_DEFAULT_PROVIDER')
        ];
        return $this->requestToAPI('POST', '/',  $data);
    }

    /**
     * @inheritDoc
     */
    public function bulkSend(array $toMobileNumbers, string $text, array $options = [])
    {
        $toMobileNumbersCsv = implode(',', $toMobileNumbers);

        return $this->send($toMobileNumbersCsv, $text, $options);
    }
}
