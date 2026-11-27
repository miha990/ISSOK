<?php

namespace App\Http\Controllers;
use App\Models\PetShop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PetShopController extends Controller{

    public function index()
    {
        $pets = PetShop::all();
        $totalPets = PetShop::count();
        $petsWithoutVaccination = PetShop::whereNull('next_vaccination_date')->count();

        return view('petshops/index', compact('pets', 'totalPets', 'petsWithoutVaccination'));
    }

    public function create()
    {
        return view('petshops/create');
    }

    public function store(Request $request): RedirectResponse
    {
        PetShop::query()->create($request->all());

        return redirect()->route('petshops.index');
    }


    public function edit(PetShop $petshop)
    {
        return view('petshops/edit', ['petShop' => $petshop]);
    }

    public function update(Request $request, PetShop $petshop): RedirectResponse
    {
        $petshop->update($request->all());

        return redirect()->route('petshops.index');
    }

    public function destroy(PetShop $petshop): RedirectResponse
    {
        $petshop->delete();

        return redirect()->route('petshops.index');
    }

}
