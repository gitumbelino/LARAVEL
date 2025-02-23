<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;

class BandController extends Controller
{
    public function allBands()
    {
        $search = request()->query('search') ? request()->query('search') : null;
        $allBands = $this->getAllBandsFromDB($search);
        return view('bands.all_bands', compact('allBands'));
    }

    protected function getAllBandsFromDB($search)
    {
        $bands = DB::table('bands');

        if ($search) {
            $bands = $bands
                ->where('name', 'like', "%{$search}%");
        }

        $bands = $bands->select('name', 'id', 'user_id', 'image')
            ->get();

        return $bands;
    }

    public function addBand(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'image' => 'required|string'
        ]);

        DB::table('bands')->insert([
            'name' => $request->name,
            'image' => $request->image,
            'user_id' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('bands.add')->with('message', 'Banda adicionada com sucesso');
    }

    public function addBandForm()
    {
        return view('bands.add_bands');
    }

    public function viewBand($id)
    {
        $band = DB::table('bands')->where('id', $id)->first();
        return view('bands.view_bands', compact('band'));
    }

    public function deleteBandFromDB($id)
    {
        DB::table('bands')->where('id', $id)->delete();
        return redirect()->route('bands.all')->with('success', 'Band deleted successfully');
    }
}
