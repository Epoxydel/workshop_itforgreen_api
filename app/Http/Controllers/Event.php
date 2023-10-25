<?php

namespace App\Http\Controllers;

use App\Models\Event as EventModel;
use App\Models\Organization as OrganizationModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Event extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $needs = $request->input('needs');
        $events = EventModel::where('needs', 'LIKE', '%' . $needs . '%')
            ->get()
            ->map(function ($event) {
                $event->needs = explode(',', $event->needs);
                $organization = OrganizationModel::find($event->id_organization);

                if ($organization) {
                    $event->organization = $organization->title;
                    $event->image = $organization->image;
                }

                return $event;
            });


        $organizations = [];

        foreach ($events as $event) {
            $organization = OrganizationModel::where('id', $event->id_organization)->first(); // Utilisez 'first' au lieu de 'get'

            if ($organization) {
                $event->organization = $organization->title;
                $event->image = $organization->image;

                $organizations[] = $organization;
            }
        }

        return response()->json($events);

    }

    public function getEvent($id): JsonResponse
    {
        $events = EventModel::where('id',$id)
            ->get()
            ->map(function ($events) {
                $events->needs = explode(',', $events->needs);
                return $events;
            });
        $organization = OrganizationModel::where('id',$events[0]->id_organization)->get();
        $events[0]['organization'] = $organization[0]->title;
        $events[0]['image'] = $organization[0]->image;

        return response()->json($events);
    }
}
