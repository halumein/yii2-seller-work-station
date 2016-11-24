<?php

namespace halumein\sws\controllers;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;


/**
 * Default controller for
 */
class ShowcaseController extends Controller
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $categoryModelClass = $this->module->categoryModel;

        $categoryModel = new $categoryModelClass();

        $categoryModels = $categoryModel::find()->all();

        $categories = [];
        $productsArray = [];

        foreach ($categoryModels as $key => $categoryModel) {
            $categories[$categoryModel->id]['name'] = $categoryModel->name;
            $categories[$categoryModel->id]['image'] = $categoryModel->getImage()->getUrl();
            $categories[$categoryModel->id]['parentCategoryId'] = isset($categoryModel->parent_id) ? $categoryModel->parent_id : null;
            $categories[$categoryModel->id]['childCategories'] = isset($categoryModel->childs)  ? ArrayHelper::getColumn($categoryModel->childs, 'id') : null;
            $products = $categoryModel->getProducts()->all();
            $categories[$categoryModel->id]['products'] = [];
            foreach ($products as $key => $product) {

                // $productsArray[$product->id]['modelName'] =  $product::className();
                // $productsArray[$product->id]['model'] =  $product;
                // $productsArray[$product->id]['name'] =  $product->name;
                // $productsArray[$product->id]['price'] =  $product->getPrice();
                // $productsArray[$product->id]['image'] = $product->getImage()->getUrl();

                $categories[$categoryModel->id]['products'][$product->id]['modelName'] =  $product::className();
                $categories[$categoryModel->id]['products'][$product->id]['model'] =  $product;
                $categories[$categoryModel->id]['products'][$product->id]['name'] =  $product->name;
                $categories[$categoryModel->id]['products'][$product->id]['price'] =  $product->getPrice();
                $categories[$categoryModel->id]['products'][$product->id]['image'] = $product->getImage()->getUrl();
                foreach ($product->modifications as $key => $modification) {
                    $categories[$categoryModel->id]['products'][$product->id]['modifications'][$modification->id]['name'] = $modification->name;
                    $categories[$categoryModel->id]['products'][$product->id]['modifications'][$modification->id]['price'] = $modification->price;
                }
            }
        }


        return $this->render('index', [
            'categories' => $categories,
            'products' => $productsArray,
            // 'modifications' => $modifications
        ]);
    }


}
