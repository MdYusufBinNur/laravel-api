<?php

namespace App\Http\Controllers\Stats;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stats\IndexRequest;
use App\Http\Resources\Stats\StaffReminderResource;
use App\Services\StatsHelper\StaffReminderHelper;

class StaffReminderController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return StaffReminderResource
     */
    public function index(IndexRequest $request)
    {
        $staffReminders = StaffReminderHelper::staffRemindersStats($request->all());

        return new StaffReminderResource($staffReminders);
    }
}
