<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Category extends Model
{
    use HasFactory;
    protected static $imageURL;
    protected static $type;
    protected static $imageName;
    protected static $directory;
    protected static $image;

    private static function imageUpload($image)
    {
        self::$type         = $image->getClientOriginalExtension();
        self::$imageName    = time().'.'. self::$type ;
        self::$directory    = 'category-images/';
        $image->move( self::$directory, self::$imageName);
        return  self::$directory. self::$imageName;
    }

    public static function newCategory($request)
    {
        if ( self::$image = $request->file('image'))
        {
            self::$imageURL  = Category::imageUpload( self::$image);
        }
        else
        {
            self::$imageURL = 'DummyImage.png';
        }

        Category::saveBasicInfo(new Category(),$request,self::$imageURL);

    }

    public static function updateCategory($category, $request)
    {
        if(self::$image = $request->file('image'))
        {
                if (file_exists($category->image ))
                {
                    if($category->image != 'DummyImage.png')
                    {
                        unlink($category->image);
                     }
                 }

            self::$imageURL  = Category::imageUpload( self::$image);
        }
        else
        {
            self::$imageURL = $category->image;
//            self::$imageURL = 'DummyImage.png';
        }
        Category::saveBasicInfo($category,$request,self::$imageURL);

    }


//    public static function updateCategory($category, $request)
//    {
//        if ( self::$image = $request->file('image'))
//        {
//            if ($category->image != 'DummyImage.png')
//            {
//                if (file_exists($category->image))
//                {
//                    unlink($category->image);
//                }
//            }
//
//            self::$imageURL  = Category::imageUpload( self::$image);
//        }
//        else
//        {
//            self::$imageURL = $category->image;
////            self::$imageURL = 'DummyImage.png';
//        }
//        Category::saveBasicInfo($category,$request,self::$imageURL);
//
//    }

    private static function saveBasicInfo($category, $request, $imageURL)
    {
        $category->name          = $request->name;
        $category->description   = $request->description;
        $category->image         = $imageURL;
        $category->save();
    }
}
