<?php

namespace App\Mail\ModuleProperty;

use App\DbModels\ModuleProperty;
use App\DbModels\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ModulePropertyUpdated extends Mailable
{
    use SerializesModels;
    /**
     * @var ModuleProperty
     */
    public $moduleProperty;

    /**
     * @var ModuleProperty
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param ModuleProperty $moduleProperty
     * @param User $user
     */
    public function __construct(ModuleProperty $moduleProperty, User $user)
    {
        $this->moduleProperty = $moduleProperty;
        $this->user = $user;
    }

    /**
     * Send module property updated mail to admins.
     *
     * @return $this
     */
    public function build()
    {
        $module = $this->moduleProperty->module;
        $property = $this->moduleProperty->property;
        $status = $this->moduleProperty->value ? 'Activated' : 'Deactivated';
        $subject = $module->title . ' module has been ' . $status;
        return $this->subject($subject)->view('module-property.index')
            ->with([
                'moduleProperty' => $this->moduleProperty,
                'module' => $module,
                'property' => $property,
                'user' => $this->user,
            ]);
    }
}
