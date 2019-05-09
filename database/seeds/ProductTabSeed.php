<?php

use Illuminate\Database\Seeder;

use App\ProductTab;
use App\ProductTabTranslation;

class ProductTabSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$arrTab = array(
			'desc'=>array(
				array('Specifications (Imperial)', 'Specifications (Imperial)'), 
				array('Dimensions (Imperial)', 'Dimensions (Imperial)'), 
				array('Specifications (Metric)', 'Specifications (Metric)'), 
				array('Dimensions (Metric)', 'Dimensions (Metric)'),
				array('Repair Sheets', 'Repair Sheets')
			),
			'lang' => array('en', 'fr')
		);
	
		foreach ($arrTab['desc'] as $productTabId => $data) {
				$productTab = ProductTab::create(['order'=>$productTabId+1 , 'status'=>1]);
			foreach ($data as $key => $value) {
				$lang = $arrTab['lang'][$key];
				if(isset($productTab)) {
			        ProductTabTranslation::create(
			        	['product_tab_id'=>$productTabId+1, 'language_code'=>$lang, 'name'=>$value]
			        );
				}
			}
		}

    }
}
