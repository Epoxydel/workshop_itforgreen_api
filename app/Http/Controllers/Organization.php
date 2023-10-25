<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Organization as OrganizationModel;
use App\Models\Event as EventModel;

class Organization extends Controller
{
    public function index(Request $request): JsonResponse
    {
        if ($request->input('type') !== null) {
            $type = $request->input('type');
            $organizations = OrganizationModel::where('status', 1)
                ->where('type', 'LIKE', '%' . $type . '%')
                ->get();
        } else {
            $organizations = OrganizationModel::where('status', '!=', 0)->get();
        }
        return response()->json($organizations);
    }

    public function allType(): JsonResponse
    {
        $organizations = OrganizationModel::where('status', 1)
            ->select('type')
            ->get();
        $uniqueValues = [];

        $organizations->map(function($organization) use (&$uniqueValues) {
            $uniqueValues = array_merge($uniqueValues, explode(',', $organization->type));
        });

        $uniqueValues = array_unique($uniqueValues);
        $result = new \stdClass();
        $result->type = $uniqueValues;

        return response()->json($result);
    }

    public function getOrganization($id): JsonResponse
    {
        $organization = OrganizationModel::where('id',$id)->get();
        $events = EventModel::where('id_organization',$id)->get();

        $organizationData = $organization->toArray();
        $eventsData = $events->toArray();
        $organizationData[0]['events'] = $eventsData;

        return response()->json($organizationData);
    }
}
