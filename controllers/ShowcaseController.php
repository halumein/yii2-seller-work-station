<?php

namespace halumein\sws\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * Default controller for
 */
class ShowcaseController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->module->adminRoles,
                    ],
                ]
            ],
        ];
    }


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
            $categories[$categoryModel->id]['childCategories'] = isset($categoryModel->childs) ? ArrayHelper::getColumn($categoryModel->childs, 'id') : [];
            $products = $categoryModel->getProducts()->all();

            $categories[$categoryModel->id]['products'] = [];

            foreach ($products as $key => $product) {
                // $productsArray[$product->id]['modelName'] =  $product::className();
                // $productsArray[$product->id]['model'] =  $product;
                // $productsArray[$product->id]['name'] =  $product->name;
                // $productsArray[$product->id]['price'] =  $product->getPrice();

                $productsArray[$product->id]['image'] = $product->getImage()->getUrl();

                $categories[$categoryModel->id]['products'][$product->id]['modelName'] = $product::className();
                $categories[$categoryModel->id]['products'][$product->id]['model'] = $product;
                $categories[$categoryModel->id]['products'][$product->id]['name'] = $product->name;
                $categories[$categoryModel->id]['products'][$product->id]['price'] = $product->getPrice();
                $categories[$categoryModel->id]['products'][$product->id]['code'] = $product->code;
                $categories[$categoryModel->id]['products'][$product->id]['image'] = $product->getImage()->getUrl();

                //foreach ($product->modifications as $key => $modification) {
                //    $categories[$categoryModel->id]['products'][$product->id]['modifications'][$modification->id]['name'] = $modification->name;
                //    $categories[$categoryModel->id]['products'][$product->id]['modifications'][$modification->id]['price'] = $modification->price;
                //}

            }
        }

        $addElementToCartUrl = $this->module->addElementToCartUrl;

        return $this->render('index', [
            'module' => $this->module,
            'categories' => $categories,
            'products' => $productsArray,
            'productItemView' => $this->module->productItemView,
            'addElementToCartUrl' => $addElementToCartUrl,
            // 'modifications' => $modifications
        ]);
    }

    public function actionServiceMini()
    {

        if ($type = yii::$app->request->get('service-view-type')) {
            if (!in_array($type, ['sws', 'table'])) {
                return $this->redirect('404');
            }

            yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'service-view-type',
                'value' => $type
            ]));
        } else {
            $type = yii::$app->request->cookies->get('service-view-type');

            if (!$type) {
                $type = 'sws';
            }
        }

        $categoryModelClass = $this->module->categoryModel;

        $categoryModel = new $categoryModelClass();

        $categoryModels = $categoryModel::find()->all();

        $addElementToCartUrl = $this->module->addElementToCartUrl;

        if ($type == 'sws') {

            $categories = [];
            $productsArray = [];

            foreach ($categoryModels as $key => $categoryModel) {
                $categories[$categoryModel->id]['name'] = $categoryModel->name;
                $categories[$categoryModel->id]['image'] = $categoryModel->getImage()->getUrl();
                // TODO $categoryModel->parent_id && != 0
                $categories[$categoryModel->id]['parentCategoryId'] = isset($categoryModel->parent_id) ? $categoryModel->parent_id : null;
                $categories[$categoryModel->id]['childCategories'] = isset($categoryModel->childs) ? ArrayHelper::getColumn($categoryModel->childs, 'id') : [];

                $tariffs = $categoryModel->getTariffs()->all();
                $categories[$categoryModel->id]['products'] = [];

                foreach ($tariffs as $key => $tariff) {

                    // $productsArray[$tariff->id]['image'] = $tariff->service->getImage()->getUrl();

                    $categories[$categoryModel->id]['products'][$tariff->id]['modelName'] = $tariff::className();
                    $categories[$categoryModel->id]['products'][$tariff->id]['model'] = $tariff;
                    $categories[$categoryModel->id]['products'][$tariff->id]['name'] = $tariff->service->name;
                    $categories[$categoryModel->id]['products'][$tariff->id]['price'] = $tariff->price;
                    $categories[$categoryModel->id]['products'][$tariff->id]['maxDiscount'] = $tariff->max_discount;
                    // $categories[$categoryModel->id]['products'][$tariff->id]['image'] = $tariff->service->getImage()->getUrl();
                }
            }

            return $this->render('index', [
                'module' => $this->module,
                'type' => $type,
                'categories' => $categories,
                'products' => $productsArray,
                'productItemView' => $this->module->productItemView,
                'addElementToCartUrl' => $addElementToCartUrl,
            ]);

        } else {
            
            $categoriesArray = [];
            
            foreach ($categoryModels as $categoryModel) {
                
                $categoriesArray[$categoryModel->id]['name'] = $categoryModel->name;

                $tariffs = $categoryModel->getTariffs()->all();

                foreach ($tariffs as $tariff) {
                    if ($service = $tariff->service ) {
                        
                        $products[$tariff->service->id] = [
                            'id' => $service->id,
                            'name' => $service->name
                        ];
                        
                        $tariffsArray[$categoryModel->id][$service->id] = [
                            'id' => $tariff->id,
                            'modelName' => $tariff::className(),
                            'name' => $service->name,
                            'price' => $tariff->price,
                            'maxDiscount' => $tariff->max_discount,
                        ];
                    }
                }
            }

            return $this->render('index', [
                'module' => $this->module,
                'type' => $type,
                'tariffs' => $tariffsArray,
                'products' => $products,
                'categories' => $categoriesArray,
                'productItemView' => $this->module->productItemView,
                'addElementToCartUrl' => $addElementToCartUrl,
            ]);
        }


    }

}
