<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductsImages;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function removeImage(Request $request)
    {
        $imageName = $request->get('imageName');

        if(Storage::disk('public')->exists($imageName)){
            Storage::disk('public')->delete($imageName);
        }

        $destroyImage = ProductsImages::where('image', $imageName);

        $productId = $destroyImage->first()->product_id;

        $destroyImage->delete();

        flash('Imagem removida com sucesso!')->success();
        return redirect()->route('admin.products.edit', ['product' => $productId]);
    }
}
