<?php
class Sttl_Homepageproduct_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
     $this->loadLayout();
     $this->renderLayout();
    }
  
	public function responseAction() {
			
            $id = $this->getRequest()->getParam('id');
			
            if($id) {
                
                $product = Mage::getModel('catalog/product')->load($id);
				$helperObj = new Mage_Catalog_Helper_Image;
				$listObj = new Mage_Catalog_Block_Product_List;
				$src1 = $helperObj->init($product,"small_image")->resize(350);
				$desc = Mage::helper('core/string')->truncate($product->getDescription(),400,'...More', $_remainder, false);
				$alt = $listObj->stripTags($listObj->getImageLabel($product, 'small_image'), null, true);
				//$alt = $product->getName();
				$images = '<span id="image1"><a href="'.$product->getProductUrl().'" title="'.$alt.'" class="product-image">
				<img src="'.$src1.'" alt="'.$alt.'" /></a></span>';
				$arr = array (
							'productName'=>$product->getName(),
							'productUrl'=>$product->getProductUrl(),
							'productSmallimage'=>$images,
							'productDescription'=>$desc
				);
				echo json_encode($arr);
            }
        }
}
?>
