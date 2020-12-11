<?php
/**
* @file exportArticle.php
* @brief 导出文章列表
* @author zc<lyzhouchao@126.com>
* @version 1.0
* @date 2020-12-10
 */


include dirname(__FILE__) . "/Abstract.php";
//让程序一直运行
set_time_limit(0);
//设置程序运行内存
ini_set('memory_limit', '128M');
class ExportArticle extends AbstractAction{
    const LIMIT = 5000;//每次输出条数
    public function run(){
        $objDb = $this->getDb();
        $sql = "select count(1) from `draw_article`";
        $intRow = $objDb->getOne($sql);
        if($intRow == 0){
           echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>提示</title><script language=javascript>alert("暂无数据");</script></head></html>';exit;
        }
        $fileName = '测试导出文章数据';
        header('Content-Encoding: UTF-8');
        header("Content-type:application/vnd.ms-excel;charset=UTF-8");
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

         //打开php标准输出流
        $fp = fopen('php://output', 'a');

         //添加BOM头，以UTF8编码导出CSV文件，如果文件头未添加BOM头，打开会出现乱码。
        fwrite($fp, chr(0xEF).chr(0xBB).chr(0xBF));
         //添加导出标题
        fputcsv($fp, ['编号', '手机号', '文章内容']);
        $intLastId = 0;
        $intCeil = ceil($intRow/self::LIMIT);
        for($i = 0; $i < $intCeil; $i++) {
            $start = $i * self::LIMIT;
            $sqlArticle = "select `tel`, `article` from `draw_article` where id > $intLastId order by id limit ". self::LIMIT;
            $arrArticle = $objDb->select($sqlArticle);
            //获取所有的tel_id, 查询手机号
            foreach ($arrArticle as $k=> $item) {
                $data['id'] = $k+1;
                $data['tel'] = $item['tel'];
                $data['article'] = $item['article'];
                fputcsv($fp, $data);
            }
             //每1万条数据就刷新缓冲区
            ob_flush();
            flush();
        }
    }

}


$obj = new ExportArticle();
$obj->run();
