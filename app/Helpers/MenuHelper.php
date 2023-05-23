<?php 
// File: app/Helpers/MenuHelper.php
namespace App\Helpers;

class MenuHelper
{
    public static function renderCategory($category, $categories )
    {
        // Xử lý logic render menu đa cấp
            $html = "<li><a href=".route('producturl',$category->slug).">$category->name</a>";
            $children = $categories->where('cat_parent', $category->id);
            if ($children->isNotEmpty()) {
                $html .= "<ul class='sub-menu'>";
                foreach ($children as $child) {
                    $html .= renderCategory($child, $categories);
                }
                $html .= '</ul >';
            }
            $html .= '</li>';
            return $html;
   
    }
}
