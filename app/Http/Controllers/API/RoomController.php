<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rooms\CreateRoomRequest;
use App\Http\Requests\Rooms\UpdateRoomRequest;
use App\Http\Resources\ResponseResource;
use App\Models\Category;
use App\Models\Room;
use App\Models\RoomHasImage;
use Illuminate\Http\Response;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $category;
    protected $room;
    protected $roomHasImage;

    public function __construct(Category $category, Room $room, RoomHasImage $roomHasImage)
    {
        $this->category = $category;
        $this->room = $room;
        $this->roomHasImage = $roomHasImage;
    }

    public function index()
    {
        try {
            return new ResponseResource(Room::latest('id')->with('images')->paginate(5));
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message . $th], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoomRequest $request)
    {
        try {
            $dataCreate = $request->except('images');
            print($dataCreate['category_id']);
            $images = $request->images ? $request->images : [];

            $room = $this->room->create($dataCreate);

            $imageArray = [];

            foreach ($images as $item) {
                $imageArray[] = ['url' => $item['url'], 'room_id' => $room->id];
            }
            $this->roomHasImage->insert($imageArray);
            $message = $this->getMessage('CREATE_SUCCESS');
            return response()->json(['message' => $message], 200);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message . $th], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $room = $this->room->with('images')->findOrFail($id);
            return $this->sentSuccessResponse($room, '', Response::HTTP_OK);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, $id)
    {
        try {
            $dataUpdate = $request->except('images');
            $room = $this->room->findOrFail($id);
            $room->update($dataUpdate);

            $images = $request->images ? $request->images : [];

            $imageArray = [];
            foreach ($images as $image) {
                $imageArray[] = ['url' => $image['url'], 'room_id' => $room->id];
            }
            $room->images()->delete();
            $this->roomHasImage->insert($imageArray);

            $message = $this->getMessage('UPDATE_SUCCESS');
            return response()->json(['message' => $message], 200);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $room = Room::findOrFail($id);
            $room->delete();
            $message = $this->getMessage('DELETE_SUCCESS');
            return response()->json(['message' => $message], 200);
        } catch (\Throwable $th) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message], 500);
        }
    }
}
