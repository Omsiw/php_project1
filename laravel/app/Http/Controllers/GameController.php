<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Game;
use App\Models\Publisher;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\GameRequest;

class GameController extends BaseController
{
    protected $model = Game::class;   

    public function item($id){
        $game = Game::with(['os','author','tag','publisher'])->findOrFail($id);

        if ($game->image_path == null){
            $imgUrl = Storage::url($game->image_path);
        } else{
            $imgUrl = null;
        }

        return response()->json([
            'id' => $game->id,
            'name' => $game->name,
            'cost' => $game->cost,
            'date_add' => $game->date_add,
            'info' => $game->info,
            'img' => $imgUrl,
            'os' => $game->os,
            'tag' => $game->tag,
            'author' => $game->author,
            'publisher' => $game->publisher
        ], 200);
    }

    public function randomGames(){
        $games = Game::inRandomOrder()->limit(10)->get();

        //dd($games); //?page=2

        $data = [];
        

        foreach($games as $game){
            if ($game->image_path == null){
                $imgUrl = Storage::url($game->image_path);
            } else{
                $imgUrl = null;
            }
            $data[] = [
                'id' => $games->id,
                'name' => $game->name,
                'cost' => $game->cost,
                'date_add' => $game->date_add,
                'info' => $game->info,
                'img' => $imgUrl
            ];
        }

        //dd($data);

        return response()->json($data, 200);
    }

    public function list(){
        $games = Game::paginate(10);

        //dd($games); //?page=2

        $data = [];
        

        foreach($games as $game){
            if ($game->image_path == null){
                $imgUrl = Storage::url($game->image_path);
            } else{
                $imgUrl = null;
            }
            $data[] = [
                'id' => $game->id,
                'name' => $game->name,
                'cost' => $game->cost,
                'date_add' => $game->date_add,
                'info' => $game->info,
                'img' => $imgUrl
            ];
        }

        //dd($data);

        return response()->json($data, 200);
    }

    public function selectByUserId($id)
    {
        $game = User::find($id)->game();

        return response()->json($game, 200);
    }

    public function selectByTagId($id)
    {
        $game = Tag::find($id)->game();

        return response()->json($game, 200);
    }

    public function selectByAuthorId($id)
    {
        $game = Author::find($id)->game();

        return response()->json($game, 200);
    }

    public function selectByPublisherId($id)
    {
        $game = Publisher::find($id)->game();

        return response()->json($game, 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationRules());
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }
        if ($request->hasFile('img')){
            
            $path = $request->file('img')->store('game_icons');
        } else{
            $path = null;
        }

        $game = Game::create([
            "name" => $request->name,
            "cost" => $request->cost,
            "date_add" => $request->date_add,
            "info" => $request->info,
            'image_path' => $path
        ]);

        $game->os()->attach($request->os_ids);
        $game->tag()->attach($request->tag_ids);
        $game->author()->attach($request->author_ids);
        if ($request->publisher_ids != null){
            $game->publisher()->attach($request->publisher_ids);
        }

        return response()->json($game, 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->getValidationRules());
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        $game = Game::findOrFail($id);

        if( $request->hasFile('img')){
            Storage::delete($game->image_path);
            $path = $request->file('img')->store('game_icons');
        } else{
            $path = null;
        }

        $game->update([ 
            "name" => $request->name,
            "cost" => $request->cost,
            "date_add" => $request->date_add,
            "info" => $request->info,
            'image_path' => $path
        ]);

        $game->os()->detach();
        $game->tag()->detach();
        $game->author()->detach();
        $game->publisher()->detach();

        $game->os()->attach($request->os_ids);
        $game->tag()->attach($request->tag_ids);
        $game->author()->attach($request->author_ids);
        if ($request->publisher_ids == null){
            $game->publisher()->attach($request->author_ids);
        } else{
            $game->publisher()->attach($request->publisher_ids);
        }

        return response()->json($game, 202);
    }

    public function destroy($id)
    {
        $game = Game::find($id);
        if($game->image_path !=null){
            Storage::delete($game->image_path);
        }
        $game->user()->detach();
        $game->os()->detach();
        $game->tag()->detach();
        $game->author()->detach();
        $game->publisher()->detach();

        $game->delete();

        return response()->json($game, 204);
    }

    
    protected function getValidationRules(){
         return (new GameRequest())->rules();
    }
}
