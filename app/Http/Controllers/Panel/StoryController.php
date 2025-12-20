<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::orderBy('order', 'asc')->get();
        return view('panel.stories.index', compact('stories'));
    }

    public function create()
    {
        return view('panel.stories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'images' => 'nullable|string', // comma separated paths
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
        ]);

        $images = [];
        if(!empty($data['images'])) {
            $images = array_values(array_filter(array_map('trim', explode(',', $data['images']))));
        }

        Story::create([
            'title' => $data['title'] ?? null,
            'images' => $images,
            'order' => $data['order'] ?? 0,
            'active' => isset($data['active']) ? (bool)$data['active'] : true,
        ]);

        return redirect()->route('panel.stories.index')->with('success', 'Story criada.');
    }

    public function edit($id)
    {
        $story = Story::findOrFail($id);
        return view('panel.stories.edit', compact('story'));
    }

    public function update(Request $request, $id)
    {
        $story = Story::findOrFail($id);

        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'images' => 'nullable|string',
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
        ]);

        $images = [];
        if(isset($data['images']) && !empty($data['images'])) {
            $images = array_values(array_filter(array_map('trim', explode(',', $data['images']))));
        }

        $story->update([
            'title' => $data['title'] ?? null,
            'images' => $images,
            'order' => $data['order'] ?? 0,
            'active' => isset($data['active']) ? (bool)$data['active'] : $story->active,
        ]);

        return redirect()->route('panel.stories.index')->with('success', 'Story atualizada.');
    }

    public function destroy($id)
    {
        $story = Story::findOrFail($id);
        $story->delete();
        return redirect()->route('panel.stories.index')->with('success', 'Story removida.');
    }
}
