<?php

namespace App\Http\Controllers\Admin\Major;

use App\Models\Major;
use App\Models\Doctor;
use App\Traits\UploadFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Major\StoreMajorRequest;
use App\Http\Requests\Admin\Major\UpdateMajorRequest;

class MajorController extends Controller
{
    use UploadFile;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = Major::select('id', 'title', 'status', 'image')
            ->paginate();
        return view('admin.pages.major.index', compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = Major::$status;
        return view('admin.pages.major.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMajorRequest $request)
    {
        $data = $request->validated();
        $data['image'] = UploadFile::upload($request->file('image'), 'image/majors');
        Major::create($data);
        return back()
            ->with('success', 'major created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Major $major)
    {
        $doctors = Doctor::where('major_id', $major->id)
            ->paginate();
        return view('admin.pages.major.show', compact('doctors', 'major'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Major $major)
    {
        $status = Major::$status;
        return view('admin.pages.major.edit', compact('status', 'major'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMajorRequest $request, Major $major)
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['image'] = UploadFile::upload($request->file('image'), 'image/majors');
            if (file_exists(public_path('image/majors/' . $major->image))) {
                unlink(public_path('image/majors/' . $major->image));
            }
        }
        $major->update($data);
        return back()
            ->with('success', 'major updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major)
    {
        if (file_exists(public_path('image/majors/' . $major->image))) {
            unlink(public_path('image/majors/' . $major->image));
        }
        $major->delete();
        return back()
            ->with('success', 'major deleted successfully');
    }
}
