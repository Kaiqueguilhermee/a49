<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryApiController extends Controller
{
    protected function validateToken(Request $request)
    {
        $token = $request->header('X-Admin-Token');
        if (empty($token) || $token !== env('EXTERNAL_ADMIN_TOKEN')) {
            return false;
        }
        return true;
    }

    public function index(Request $request)
    {
        if(!$this->validateToken($request)) return response()->json(['error' => 'unauthorized'], 401);
        $stories = Story::orderBy('order', 'asc')->get();
        return response()->json(['stories' => $stories]);
    }

    public function show(Request $request, $id)
    {
        if(!$this->validateToken($request)) return response()->json(['error' => 'unauthorized'], 401);
        $story = Story::find($id);
        if(!$story) return response()->json(['error' => 'not_found'], 404);
        return response()->json(['story' => $story]);
    }

    public function store(Request $request)
    {
        if(!$this->validateToken($request)) return response()->json(['error' => 'unauthorized'], 401);

        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
        ]);

        $story = Story::create([
            'title' => $data['title'] ?? null,
            'images' => $data['images'] ?? [],
            'order' => $data['order'] ?? 0,
            'active' => isset($data['active']) ? (bool)$data['active'] : true,
        ]);

        return response()->json(['story' => $story], 201);
    }

    public function update(Request $request, $id)
    {
        if(!$this->validateToken($request)) return response()->json(['error' => 'unauthorized'], 401);
        $story = Story::findOrFail($id);

        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
        ]);

        $story->update([
            'title' => $data['title'] ?? $story->title,
            'images' => $data['images'] ?? $story->images,
            'order' => $data['order'] ?? $story->order,
            'active' => isset($data['active']) ? (bool)$data['active'] : $story->active,
        ]);

        return response()->json(['story' => $story]);
    }

    public function destroy(Request $request, $id)
    {
        if(!$this->validateToken($request)) return response()->json(['error' => 'unauthorized'], 401);
        $story = Story::find($id);
        if(!$story) return response()->json(['error' => 'not_found'], 404);
        $story->delete();
        return response()->json(['deleted' => true]);
    }
}
