<?php
/**
 * Created by PhpStorm.
 * User: faraone
 * Date: 2017/11/27
 * Time: 下午11:13
 */
namespace App\Api;

use PhalApi\Api;
use QL\QueryList;

class Hello extends Api{
    /**
     *
     */
    public function world()
    {
        set_time_limit(0);
       # $coun=new Country();
        //获取采集对象
        $hj = QueryList::Query('https://www.alexa.com/topsites/countries',array(
            'title'=>array('.countries li a','text'),
            'link'=>array('.countries li a','href')
        ));

        foreach ($hj->data as $country){
            print_r($country);die;
            #保存国家数据
            if(!$coun::count('name="'.$country['title'].'"'))
            {
                $coun=new Country();
                $coun->name=$country['title'];
                $coun->show_in_front=1;
                $coun->iso_code=str_replace("/topsites/countries/",'',$country['link']);
                $aa=  $coun->create();


            }
        }

        //输出结果：二维关联数组
        print_r($hj->data);die;

        phpQuery::newDocumentFile('https://www.alexa.com/topsites/countries/AF');

        $artlist = pq(".listings  .site-listing");
        $rs=[];
        foreach($artlist as $li){
            $result = pq($li)->find(".right p")->getStrings();
            array_push($result,pq($li)->find(".DescriptionCell p")->text());
            $desc=pq($li)->find(".DescriptionCell .description ")->text();
            $desc=str_replace(pq($li)->find(".DescriptionCell .description .trucate:eq(0)")->text(),'',$desc);
            $desc=str_replace(pq($li)->find(".DescriptionCell .description .trucate:eq(1)")->text(),'',$desc);
            array_push($result,$desc);

            $rs[]=$result;
        }
        print_r($rs);die;
        var_dump('aa');die;




        $hj =QueryList::Query(
            'https://www.alexa.com/topsites/countries/IT'
            ,array(
            'title'=>array('.DescriptionCell p a','text'),
            'description'=>array('.DescriptionCell .description','text'),
            'link'=>array('.DescriptionCell p a','href'),
            'dail_time'=>array('.right:eq(2) p','text'),
            '.listings .site-listing'
        ));
        //$hj->setQuery(array('title'=>array('','text'),'url'=>array('a','href')),'#con_two_2 li');
//输出结果：二维关联数组
        print_r($hj->data);die;
        return ['title'=>'hello world!'];
    }
}