<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getSubcategoriesByCategory(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->category_id)->get();

        // return response()->json([
        //     'subCategories' => $subCategories,
        // ]);

        $subCategoryOptions = '<option value="" disabled selected>Select Sub Category</option>';

        if ($subCategories->count() > 0) {
            foreach ($subCategories as $subCategory) {
                $subCategoryOptions .= '<option value="'.$subCategory->id.'">'.$subCategory->name.'</option>';
            }
        } else {
            $subCategoryOptions = '<option value="" disabled selected>No Sub Categories</option>';
        }

        return $subCategoryOptions;
    }
}
