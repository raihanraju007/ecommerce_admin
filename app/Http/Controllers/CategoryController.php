<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class CategoryController extends Controller
{
    protected $category;
    protected $message;

    public function index()
    {

        return view('category.manage',[
            'categories' => Category::orderBy('id','desc')->get()
        ]);
    }
    public function create(Request $request)

//        regular expression with digit
//        regex:/(^([a-zA-Z ]+)(\d+)?$)/u'
    {
        $this -> validate($request,[
            'name' => 'required|regex:/(^([a-zA-Z ]+)?$)/u|unique:categories',
            'description' => 'required',
            'image' => 'image',
        ]);
        Category::newCategory($request);
        return redirect()->back()->with('message','Category Info Save Successfully.');
    }

    public function updateStatus($id)
    {
        $this->message = $this->updateStatusInfo($id);
        return redirect()->back()->with('message',$this->message);
    }

    private function updateStatusInfo($id)
    {
        $this->category = Category::find($id);
        if ( $this->category -> status == 1)
        {
            $this->category->status = 0;
            $this->message = 'Category info unpublished successfully';
        }
        else
        {
            $this->category->status = 1;
            $this->message = 'Category info published successfully';
        }
        $this->category->save();
        return $this->message;
    }

    public function edit($id)
    {
        return view('category.edit',[
            'category' => Category::find($id),
            'categories' => Category::orderBy('id','desc')->get()
        ]);
    }

    public function update(Request $request)
    {
        $this->category = Category::find($request->id);
        Category::updateCategory($this->category, $request);
        return redirect('/manage-category')->with('message','Category Info Update Successfully.');
    }

    public function delete($id)
    {
        $this->category = Category::find($id);
        if (file_exists($this->category->image != 'DummyImage.png'))
        {
            unlink($this->category->image);
        }
        $this->category->delete();
        return redirect('/manage-category')->with('message','Category Info Delete Successfully.');
    }
}
