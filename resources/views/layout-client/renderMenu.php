
<?php
function renderCategory($category, $categories) {
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

?>
