<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Filter;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index(){
        $filters = Filter::all();
        $categories = Category::whereNotNull('parent_id')->get();

        return view('admin.filter.index', [
            'filters' => $filters,
            'categories' => $categories,
        ]);

    }

    public function findFilter(Request $request){
        $filter = Filter::find($request->filter_id);
        $categories = $filter->categories;

        return json_encode($categories);
    }

    public function create(Request $request){
        $filter = new Filter();

        $filter->name = $request->name;
        $filter->save();

        $filter->categories()->attach($request->categories);

        return redirect()->route('admin.filter.index')->with('success', 'Pomyślnie dodano nowy filtr ' . $filter->name);
    }

    public function delete(Request $request){
        $filter = Filter::find($request->filter_id);
        $filter->categories()->detach();
        $filter->variants()->detach();
        $filter->delete();

        return redirect()->route('admin.filter.index')->with('success', 'Usunięto filtr ' . $filter->name);
    }

    public function update(Request $request){
        $filter = Filter::find($request->filter_id);

        $filter->name = $request->name;
        $filter->categories()->sync($request->input_categories);

        $filter->save();

        return redirect()->route('admin.filter.index')->with('success', 'Edytowano filtr ' . $filter->name);
    }
}
