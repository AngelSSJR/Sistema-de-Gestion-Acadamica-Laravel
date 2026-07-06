<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;

class RoomController extends Controller
{
    protected function getRoutePrefix(): string
    {
        return auth()->user()->isDevAdmin() ? 'dev-admin.' : 'coordinator.';
    }

    public function index()
    {
        $rooms = Room::latest()->paginate(15);
        $routePrefix = $this->getRoutePrefix();
        return view('admin.rooms.index', compact('rooms', 'routePrefix'));
    }

    public function create()
    {
        $routePrefix = $this->getRoutePrefix();
        return view('admin.rooms.create', compact('routePrefix'));
    }

    public function store(StoreRoomRequest $request)
    {
        $prefix = $this->getRoutePrefix();
        Room::create($request->validated());

        return redirect()->route("{$prefix}rooms.index")
            ->with('success', 'Ambiente creado exitosamente.');
    }

    public function show(Room $room)
    {
        $routePrefix = $this->getRoutePrefix();
        return view('admin.rooms.show', compact('room', 'routePrefix'));
    }

    public function edit(Room $room)
    {
        $routePrefix = $this->getRoutePrefix();
        return view('admin.rooms.edit', compact('room', 'routePrefix'));
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        $prefix = $this->getRoutePrefix();
        $room->update($request->validated());

        return redirect()->route("{$prefix}rooms.index")
            ->with('success', 'Ambiente actualizado exitosamente.');
    }

    public function destroy(Room $room)
    {
        $prefix = $this->getRoutePrefix();
        $room->delete();
        return redirect()->route("{$prefix}rooms.index")
            ->with('success', 'Ambiente eliminado exitosamente.');
    }
}
