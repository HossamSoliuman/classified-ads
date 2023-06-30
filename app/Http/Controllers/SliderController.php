<?php

namespace App\Http\Controllers;

use App\Models\slider;
use App\Http\Requests\StoresliderRequest;
use App\Http\Requests\UpdatesliderRequest;
use App\Traits\ApiResponse;
use App\Traits\ManagesFiles;

class SliderController extends Controller
{
    use ApiResponse, ManagesFiles;

    public function index()
    {
        $sliders = slider::all();

        return $this->successResponse($sliders);
    }

    public function store(StoresliderRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $this->uploadFile($request->validated('image'), slider::PATH);
        $slider = slider::create($data);
        return $this->successResponse($slider, 201);
    }

    public function show(slider $slider)
    {
        return $this->successResponse($slider);
    }

    public function update(UpdatesliderRequest $request, slider $slider)
    {
        $slider->update($request->validated());

        return $this->successResponse($slider);
    }

    public function destroy(slider $slider)
    {
         $this->deleteFile($slider->image);
        $slider->delete();

        return  $this->customResponse('Slider deleted');
    }
}
