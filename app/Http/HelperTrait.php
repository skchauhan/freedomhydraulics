<?php 

namespace App\Http;
use App\ProductCategory;

trait HelperTrait{
	
    public function twoTablePluck($allCategory) {
        $arrCategory[0] = 'Select One';
        if(!empty($allCategory)) {
            foreach ($allCategory as $key => $data) {
                if(!empty($data->categoryTranslate->name)) {
                    $arrCategory[$data->id] = $data->categoryTranslate->name;
                }
            }
        }
        return $arrCategory;
    }


    public function parentChildCategory($allCategory) {
        $arrCategory[0] = 'Select One';
        if(!empty($allCategory)) {
            foreach ($allCategory as $key => $value) {
                if($value->parent_id == 0) {
                    foreach ($allCategory as $strKey => $strValue) {
                        if($value->id == $strValue->parent_id) {
                            $arrCategory[$value->categoryChldTranslate->name][$strValue->categoryChldTranslate->product_category_id] =  $strValue->categoryChldTranslate->name;
                        }
                    }
                }
            }
        }
        return $arrCategory;
    }

    public function parentNewsChildCategory($allCategory) {
        $arrCategory[0] = 'Select One';
        if(!empty($allCategory)) {
            foreach ($allCategory as $key => $value) {
                if($value->parent_id == 0) {
                    foreach ($allCategory as $strKey => $strValue) {
                        if($value->id == $strValue->parent_id) {
                            $arrCategory[$value->categoryChldTranslate->name][$strValue->categoryChldTranslate->news_category_id] =  $strValue->categoryChldTranslate->name;
                        }
                    }
                }
            }
        }
        return $arrCategory;
    }

    public function getDealerCategory( $allCategory )
    {
        $arrCategory = [];
        $arrCategory[''] = 'Select One';
      if(isset($allCategory)) {
        foreach ($allCategory as $data) {
            $arrCategory[$data->dealerCategoryAllTranslate->first()->dealer_category_id] = $data->dealerCategoryAllTranslate->first()->name;
        }
      }
      return $arrCategory;
    }

}

 ?>