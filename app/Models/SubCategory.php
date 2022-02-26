<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{

    use HasFactory;

    public static function newSubCategory($request)
    {
        if ($image = $request->file('image'))
        {
            $imgURL = self::getImageURL($image);
        }
        else
        {
            $imgURL = 'DummyImage.png';
        }
        $subCategory = new SubCategory();
        self::saveBasicInfo($subCategory,$request,$imgURL);

    }


    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }


    public static function updateSubCategory($request, $id)
    {
        $subCategory = SubCategory::find($id);

        if ($image = $request->file('image'))
        {
            if(file_exists($subCategory->image))
            {
                if($subCategory->image != 'DummyImage.png')
                {
                    unlink($subCategory->image);
                }
            }
            $imgURL = self::getImageURL($image);
        }
        else
        {
            $imgURL = $subCategory->image;
        }

      self::saveBasicInfo($subCategory,$request,$imgURL);
    }

    protected static function saveBasicInfo($subCategory,$request,$imgURL)
    {
        $subCategory->category_id = $request->category_id;
        $subCategory->name = $request->name;
        $subCategory->description = $request->description;
        $subCategory->image = $imgURL;
        $subCategory->save();
    }

    protected static function getImageURL($image)
    {
        $directory  = 'sub-category-images/';
        return imageUpload($image,$directory);
    }
}
