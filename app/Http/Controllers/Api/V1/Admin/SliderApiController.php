<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Http\Resources\Admin\SliderResource;
use App\Models\Slider;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SliderApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SliderResource(Slider::all());
    }

    public function getData()
    {
        // 'detail','header','header_second','status','image_slider','media','video'
        return new SliderResource(Slider::get(array('id','detail','header','header_second','status')));
    }

    public function store(StoreSliderRequest $request)
    {
        $slider = Slider::create($request->all());

        if ($request->input('image_slider', false)) {
            $slider->addMedia(storage_path('tmp/uploads/' . $request->input('image_slider')))->toMediaCollection('image_slider');
        }

        if ($request->input('video', false)) {
            $slider->addMedia(storage_path('tmp/uploads/' . $request->input('video')))->toMediaCollection('video');
        }

        return (new SliderResource($slider))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Slider $slider)
    {
        abort_if(Gate::denies('slider_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SliderResource($slider);
    }

    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $slider->update($request->all());

        if ($request->input('image_slider', false)) {
            if (!$slider->image_slider || $request->input('image_slider') !== $slider->image_slider->file_name) {
                if ($slider->image_slider) {
                    $slider->image_slider->delete();
                }

                $slider->addMedia(storage_path('tmp/uploads/' . $request->input('image_slider')))->toMediaCollection('image_slider');
            }
        } elseif ($slider->image_slider) {
            $slider->image_slider->delete();
        }

        if ($request->input('video', false)) {
            if (!$slider->video || $request->input('video') !== $slider->video->file_name) {
                if ($slider->video) {
                    $slider->video->delete();
                }

                $slider->addMedia(storage_path('tmp/uploads/' . $request->input('video')))->toMediaCollection('video');
            }
        } elseif ($slider->video) {
            $slider->video->delete();
        }

        return (new SliderResource($slider))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Slider $slider)
    {
        abort_if(Gate::denies('slider_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $slider->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
