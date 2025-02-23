<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;


class AlbumController extends Controller
{
    public function allAlbums()
    {
        $search = request()->query('search') ? request()->query('search') : null;
        $allAlbums = $this->getAllAlbumsFromDB($search);
        return view('albums.all_albums', compact('allAlbums'));
    }

    protected function getAllAlbumsFromDB($search)
    {
        $albums = DB::table('albums');



        if ($search) {
            $albums = $albums
                ->where('name', 'like', "%{$search}%");
        }
        $albums = $albums->select('name', 'release_date', 'id', 'band_id', 'image')
            ->get();

        return $albums;
    }

    public function addAlbumForm()
    {
        $bands = DB::table('bands')->select('id', 'name')->get();
        return view('albums.add_album', compact('bands'));
    }

    public function addAlbum(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'release_date' => 'required|date',
            'band_id' => 'required|exists:bands,id',
            'image' => 'nullable|string',
        ]);

        DB::table('albums')->insert([
            'name' => $request->name,
            'release_date' => $request->release_date,
            'band_id' => $request->band_id,
            'image' => $request->image,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('albums.all')->with('success', 'Album added successfully');
    }


    public function viewAlbum($id)
    {
        $album = DB::table('albums')->where('id', $id)->first();
        return view('album.view_album', compact('album'));
    }

    public function deleteAlbumFromDB($id)
    {
        DB::table('albums')->where('id', $id)->delete();

        return redirect()->route('album.all')->with('success', 'Album deleted');

    }


    public function editAlbumForm($id)
{
    $album = DB::table('albums')->where('id', $id)->first();
    $bands = DB::table('bands')->select('id', 'name')->get();
    return view('albums.edit_album', compact('album', 'bands'));
}

public function updateAlbum(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|min:3',
        'release_date' => 'required|date',
        'band_id' => 'required|exists:bands,id',
        'image' => 'nullable|string',
    ]);

    DB::table('albums')->where('id', $id)->update([
        'name' => $request->name,
        'release_date' => $request->release_date,
        'band_id' => $request->band_id,
        'image' => $request->image,
        'updated_at' => now(),
    ]);

    return redirect()->route('albums.all')->with('success', 'Album updated successfully');
}

}
