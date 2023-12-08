<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Store;
use App\Http\Requests\StoreRequest;
use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{

    use UploadTrait;

    public function __construct()
    {
        $this->middleware('user.has.store')->only(['create', 'store']);
    }

    public function index()
    {

        $store = auth()->user()->store;

        return view('admin.stores.index', compact('store'));
    }

    public function create()
    {
        $users = User::all(['id', 'name']);

        return view('admin.stores.create', compact('users'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->all();

        $user = auth()->user();

        if($request->hasFile('logo')){
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $store = $user->store()->create($data);

        flash('Loja Criada com Sucesso!')->success();

        return redirect()->route('admin.stores.edit', ['store' => $store->id]);
    }

    public function edit($store)
    {
        $store = Store::find($store);

        return view('admin.stores.edit', compact('store'));
    }

    public function update(StoreRequest $request, $store)
    {
        $data = $request->all();

        $store = Store::find($store);

        if($request->hasFile('logo')){
            if(Storage::disk('public')->exists($store->logo)){
                Storage::disk('public')->delete($store->logo);
            }
                $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $store->update($data);

        flash('Loja Atualizada com Sucesso!')->success();

        return redirect()->route('admin.stores.edit', ['store' => $store->id]);
    }

    public function destroy($store)
    {
        $validStore = auth()->user()->store;
        if($validStore->products()->count()){
            flash('Você possui produtos relacionados a esta loja!')->warning();
            return redirect()->route('admin.stores.index');
        }

        $store = Store::find($store);

        $store->delete();

        flash('Loja Removida com Sucesso!')->success();

        return redirect()->back();
    }
}
