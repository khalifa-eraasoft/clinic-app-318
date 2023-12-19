<?php

namespace App\Http\Controllers\Api\Major;

use App\Models\Major;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Major\MajorsResource;
use App\Http\Resources\Major\MajorsCollection;
use App\Http\Resources\Major\SinglrMajorResource;

class MajorController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $majors = Major::whereHas('doctors', function ($d) {
            $d->where('status', 'active');
        })
            ->where('status', 'active')
            ->paginate();
        return $this->apiResponse(new MajorsCollection($majors));
    }

    public function show(Major $major)
    {
        $m = Major::whereHas('doctors', function ($d) {
            $d->where('status', 'active');
        })
            ->with(['doctors' => function ($d) {
                $d->where('status', 'active');
            }])
            ->where('status', 'active')
            ->findOrFail($major->id);
        return $this->apiResponse(new SinglrMajorResource($m));
    }
}
