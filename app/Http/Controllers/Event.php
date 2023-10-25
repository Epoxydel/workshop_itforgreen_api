<?php

namespace App\Http\Controllers;

use App\Models\Event as EventModel;
use App\Models\Organization as OrganizationModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Event extends Controller
{
    public function getEvent($id): JsonResponse
    {
        $events = EventModel::where('id',$id)->get();
        $events[0]['nameOrganization'] = OrganizationModel::where('id',$events[0]->id_organization)->get()[0]->name;

        return response()->json($events);
    }
}
