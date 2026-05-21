<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\FileUploadWithResizeTrait;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use FileUploadWithResizeTrait;

    public function index()
    {
        $sliders = Slider::all();

        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'required|url',
            'status' => 'required|in:0,1',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $this->upload($request->file('image'), 'uploads/slider', false, true, 1200, 380);
        }

        Slider::create([
            'title' => $request->title,
            'image' => $imagePath,
            'link' => $request->link,
            'status' => $request->status,
        ]);
        ToastMagic::success('Slider created successfully');

        return redirect()->route('admin.slider.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::findOrFail($id);

        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link' => 'required|url',
            'status' => 'required|in:0,1',
        ]);

        $slider = Slider::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $this->upload($request->file('image'), 'uploads/slider', $slider->image, true, 1200, 380);
        }

        $slider->update([
            'title' => $request->title,
            'image' => $imagePath ?? $slider->image,
            'link' => $request->link,
            'status' => $request->status,
        ]);
        ToastMagic::success('Slider updated successfully');

        return redirect()->route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        $this->delete($slider->image);
        $slider->delete();
        ToastMagic::success('Slider deleted successfully');

        return redirect()->route('admin.slider.index');
    }
}
